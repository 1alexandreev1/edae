<?php

namespace App\Services\Users;

use App\Models\User;
use App\Services\BaseService;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class UserService extends BaseService
{

    public $template = 'site.users.';
    public $translation = 'users.';
    public $route = 'users.';
    public $model;

    function __construct()
    {
        parent::__construct(User::class);
    }

    public function outputData($adminPanel = false)
    {
        $with = $this->baseOutputData($adminPanel);
        $with['block_availability'] = false;
        return $with;
    }

    public function getDatatableElements()
    {
        $query = $this->model::query();
        //тут можно поместить фильтры
        return $this->dataTableData($query, ['roles'])
            ->editColumn('name', function ($model) {
                return view('edae.name')->with(['model' => $model, 'route' => $this->route]);
            })
            ->editColumn('role', function ($model) {
                return (is_null($model->roles->first()) ? __('general.empty') : config("roles.display_name_roles.{$model->roles->first()->name}"));
            })
            ->addColumn('action', function ($model) {
                return view('edae.actions')->with(['model' => $model, 'route' => $this->route, 'permission' => $this->permission]);
            })
            // ->rawColumns(['action',])
            ->make(true);
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
            [
                'title' => __('general.role'),
                'data' => 'role',
                'name' => 'name',
            ],
            [
                'title' => __('general.created_at'),
                'data' => 'created_at',
            ],
            $this->actionButton()
        ];
    }

    public function store($request)
    {
        $model = $this->model::create($request);
        $model->assignRole('user');
        if (isset($request['avatar']) && !empty($request['avatar'])) {
            optional($model->getFirstMedia('avatar'))->delete();
            $this->addMedia($model, $request, 'avatar');
        }
        return response()->json([
            'status' => true,
            'url' => route("{$this->route}show", $model)
        ], 200);
    }

    public function edit($model = null, bool $show = false)
    {
        $with = $this->editElement($model, $show);
        $with['block_availability'] = false;
        return view($show ? "{$this->template}show" : 'edae.edit')->with($with);
    }

    public function update($model, $request)
    {
        if (empty($request['password'])) {
            unset($request['password']);
        }
        $model->update($request);
        if (isset($request['avatar']) && !empty($request['avatar'])) {
            optional($model->getFirstMedia('avatar'))->delete();
            $this->addMedia($model, $request, 'avatar');
        }
        return response()->json([
            'status' => true,
            'url' => route("{$this->route}show", $model)
        ], 200);
    }
}
