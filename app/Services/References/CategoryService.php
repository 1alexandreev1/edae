<?php

namespace App\Services\References;

use App\Models\References\Category;
use App\Services\BaseService;

class CategoryService extends BaseService
{
    public $template = 'site.categories.';
    public $route = 'categories.';
    public $translation = 'categories.';
    public $model;

    function __construct()
    {
        parent::__construct(Category::class);
    }

    public function outputData($adminPanel = false)
    {
        $with = $this->baseOutputData($adminPanel);
        return $with;
    }

    public function store($request)
    {
        $model = $this->model::create($request->all());
        return response()->json([
            'status' => true,
            'url' => route("{$this->route}show", $model)
        ], 200);
    }

    public function edit($model = null, $show = false)
    {
        $with = $this->editElement($model, $show);
        $with['categories'] = $this->model::whereNull('category_id')->get(['id', 'name']);
        return view('edae.edit')->with($with);
    }

    public function update($model, $request)
    {
        $model->update($request->all());
        return response()->json([
            'status' => true,
            'url' => route("{$this->route}edit", $model)
        ], 200);
    }
}
