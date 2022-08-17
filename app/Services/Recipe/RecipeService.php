<?php

namespace App\Services\Recipe;

use App\Models\Recipes\Recipe;
use App\Models\Tag;
use App\Services\BaseService;
use Illuminate\Support\Facades\Auth;

class RecipeService extends BaseService
{
    public $template = 'site.recipes.';
    public $route = 'recipes.';
    public $translation = 'recipes.';
    public $model;

    function __construct()
    {
        $this->with = [
            'media',
            'like',
            'likes',
            'user'
        ];
        parent::__construct(Recipe::class);
    }

    public function outputData($adminPanel = false)
    {
        $with = $this->baseOutputData($adminPanel);
        return $with;
    }

    public function getDatatableElements()
    {
        $query = $this->model::query();
        return $this->dataTableData($query)->make(true);
    }

    public function store($request)
    {
        $model = Auth::user()->recipes()->create($request->all());
        $this->ingridients($model, $request->ingredient, $request->ingredientCount);
        $model->tags()->sync($request->tags ?? []);
        $this->addMedia($model, $request);
        return response()->json([
            'status' => true,
            'url' => route("{$this->route}show", $model)
        ], 200);
    }

    public function edit($model = null, $show = false)
    {
        $with = $this->editElement($model, $show);
        $with['tags'] = Tag::where('model_type', get_class(new $this->model))->get();
        return view($show ? "{$this->template}show" : 'edae.edit')->with($with);
    }

    public function update($model, $request)
    {
        $model->update($request->all());
        $this->ingridients($model, $request->ingredient, $request->ingredientCount);
        $model->tags()->sync($request->tags ?? []);
        $this->addMedia($model, $request);
        return response()->json([
            'status' => true,
            'url' => route("{$this->route}show", $model)
        ], 200);
    }

    private function ingridients($model, $ingridients = [], $cods = null)
    {
        $jsonIngridients = [];
        if (!empty($ingridients) && !is_null($ingridients)) {
            foreach ($ingridients as $key => $item) {
                $jsonIngridients[$item] = $cods[$key];
            }
        }
        $model->ingredients = $jsonIngridients;
        $model->save();
    }
}
