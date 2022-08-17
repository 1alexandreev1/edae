<?php

namespace App\Services;

use App\Models\Media;
use App\Models\Setting;
use App\Models\Tag;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Yajra\DataTables\DataTables;
use Yajra\DataTables\Html\Builder as BuilderDT;
use Illuminate\Support\Str;

class BaseService
{
    public $model;
    public $route;
    public $template;
    public $translation;
    public $permission;
    protected $with = [];
    protected $withCount = [];
    protected $withLoad = [];
    protected $adminTemplate = 'site.admin';
    protected $siteTemplate = 'site.general';

    function __construct($model)
    {
        $this->permission = (new $model)->getTable();
        $this->model = new $model;
    }

    public function baseOutputData($adminPanel = false)
    {
        // $newModel = new $this->model;
        $with = [
            'permission' => $this->permission,
            'title' =>  __($this->translation . 'title'),
            'route' => $this->route,
            'template' => $this->template,
            'translation' => $this->translation,
            'extendsTemplate' => $this->siteTemplate,
            'block_availability' => true
        ];
        if ($adminPanel) {
            $with['dataTable'] = $this->constructViewDT();
            $with['extendsTemplate'] = $this->adminTemplate;
        } else {
            if (Setting::class === $this->model) {
                $with['models'] = $this->model::all();
            } else {
                $setting = Setting::where('slug', 'indexPage')->first()->settings;
                $with['models'] = $this->model::with($this->with)
                    ->withCount($this->withCount)
                    ->orderBy('id', 'DESC')
                    ->paginate($setting->maxPostsInIndexPage->value);
            }
        }
        return $with;
    }

    public function getDatatableElements()
    {
        $query = $this->model::query();
        return $this->dataTableData($query)->make(true);
    }

    public function getFilters($query)
    {
        return $query;
    }

    public function tableColumns()
    {
        return [
            [
                'title' => __('general.id'),
                'data' => 'id',
                'width' => '5%'
            ],
            [
                'title' => __('general.name'),
                'data' => 'name',
            ],

            $this->actionButton()
        ];
    }

    /**
     * Формирует данные для шаблона "Список элементов"
     */
    public function dataTableData($query = null, $with = [])
    {
        $query = !empty($query) ?
            $query->select($this->columnsToSelect($this->tableColumns()))->with($with) :
            $this->model::select($this->columnsToSelect($this->tableColumns()))->with($with);
        $query = $this->getFilters($query); ///фильтры
        $data =  Datatables::of($query)
            ->editColumn('name', function ($model) {
                return view('edae.name')->with(['model' => $model, 'route' => $this->route]);
            })
            ->addColumn('action', function ($model) {
                return view('edae.actions')->with(['model' => $model, 'route' => $this->route, 'permission' => $this->permission]);
            });

        return $data;
    }

    /**
     * Получаем только заголовки колонок для DT
     */
    protected function columnsToSelect($array)
    {
        if (!empty($array)) {
            $resultArray = [];
            foreach ($array as $value) {
                if (!isset($value['remove_select']) or $value['remove_select'] !== true) {
                    if (isset($value['name'])) {
                        $resultArray[] = $value['name'];
                    } else {
                        $resultArray[] = $value['data'];
                    }
                }
            }
            return $resultArray;
        }
        return $array;
    }

    /**
     * Собираем объект DataTable для фронта
     */
    public function constructViewDT($selectorForm = '#dt_filters')
    {
        return app(BuilderDT::class)
            ->language(config('datatables.lang.url'))
            ->orders([0, 'desc'])
            ->pageLength(10)
            ->ajaxWithForm('', $selectorForm)
            ->columns($this->tableColumns())
            ->parameters([
                'paging' => true,
                'searching' => true,
                'info' => true,
                'searchDelay' => 350,
                'sDom' => '<"top"l>t<"bottom">p<div><"clear">',
                'searchHighlight' => true
            ]);
    }

    /**
     * Стандартная кнопка действия для DataTable
     */
    protected function actionButton()
    {
        return [
            'title' => 'Действия',
            'remove_select' => true,
            'width' => '10%',
            'data' => 'action',
            'searchable' => false,
            'orderable' => false,
        ];
    }

    public function editElement($model = null, bool $show = false)
    {
        $with = [
            'title' => $this->getTitle($model, $show),
            'permission' => $this->permission,
            'extendsTemplate' => (optional(Auth::user())->hasPermissionTo("{$this->permission}-read") && !$show) ? $this->adminTemplate : $this->siteTemplate,
            'translation' => $this->translation,
            'template' => $this->template,
            'route' => $this->route,
            'medias' => optional($model)->getMedia('') ?? [],
            'block_availability' => true,
        ];
        if (Route::has("admin.{$this->route}storeTag")) {
            $with['url_store_tag'] = route("admin.{$this->route}storeTag");
        }
        if (!is_null($model)) {
            if ($show && isset($model->views)) {
                $model->views += 1;
                $model->save();
            }
            $with['model'] = $model;
        }
        return $with;
    }

    public function storeElement($request)
    {
        return $this->model->create($request);
    }

    private function getTitle($model, $show)
    {
        if (is_null($model)) {
            return __("general.create") . " - " . __("{$this->translation}create.title");
        } else {
            if ($show) {
                return $model->name ?? __("general.show") . " - " . __("{$this->translation}edit.title");
            } else {
                return __("general.edit") . " - " . ($model->name ?? __("{$this->translation}edit.title"));
            }
        }
    }

    public function estimation($model_id, $estimation)
    {
        $model = $this->model::find($model_id);
        $model->likes()->updateOrCreate([
            'user_id' => Auth::id(),
        ], [
            'like' => ($estimation === 'like' ? true : false),
        ]);

        return response()->json([
            'status' => true,
            'likes_count' => $model->likesCount,
            'dislikes_count' => $model->dislikesCount
        ], 200);
    }

    public function destroy($model_id)
    {
        return $this->model::destroy($model_id);
    }

    public function addMedia($model, $request, $collection = '')
    {
        $files = $request->file ?? [];
        $cods = $request->fileCode ?? null;
        if (isset($request[$collection]))
            $files = [$request[$collection]];
        if ($collection === '') {
            $model->getMedia('')
                ->whereNotIn(
                    'uuid',
                    collect($cods)
                        ->map(function ($value, $key) {
                            return Str::isUuid($key) ? $key : null;
                        })
                )
                ->map(function ($media) {
                    return $media->delete();
                });
        }

        collect($files)->map(function ($file, $key) use ($model, $cods, $collection) {
            if (is_null($cods)) {
                $model->addMedia($file)
                    ->toMediaCollection($collection);
            } else {
                $model->addMedia($file)
                    ->withCustomProperties(['code' => $cods[$key]])
                    ->toMediaCollection($collection);
            }
        });
        return true;
    }

    public function storeTag($request)
    {
        $tag = Tag::create([
            'name' => $request->name,
            'model_type' => get_class($this->model)
        ]);

        return response()->json([
            'status' => is_null($tag) ? false : true,
            'tag' => [
                'id' => $tag->id,
                'name' => $tag->name
            ],
        ]);
    }

    public function storeComment($model_id, $request)
    {
        $model = $this->model::find($model_id);
        $request['user_id'] = Auth::id();
        $comment = $model->comments()->create($request);
        $comments = $model->comments()->where('created_at', '>', Carbon::parse($request['lastCommentDate']))->get();
        $commentsHtml = view('edae.comments')->with(['comments' => $comments])->render();
        return response()->json([
            'status' => is_null($comment->id) ? false : true,
            'commentsHtml' => $commentsHtml,
            'lastCommentDate' => $comments->last()->created_at,
        ], 200);
    }
}
