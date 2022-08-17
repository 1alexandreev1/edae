<?php

namespace App\Services\News;

use App\Models\News\News;
use App\Models\Tag;
use App\Services\BaseService;
use Illuminate\Support\Facades\Auth;

class NewsService extends BaseService
{
    public $template = 'site.news.';
    public $route = 'news.';
    public $translation = 'news.';
    public $model;

    function __construct()
    {
        $this->with = [
            'media',
            'like',
            'likes',
            'user'
        ];
        parent::__construct(News::class);
    }

    public function outputData($adminPanel = false)
    {
        $with = $this->baseOutputData($adminPanel);
        return $with;
    }

    public function store($request)
    {
        $model = Auth::user()->news()->create($request->all());
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
        $model->tags()->sync($request->tags ?? []);
        $this->addMedia($model, $request);
        return response()->json([
            'status' => true,
            'url' => route("{$this->route}show", $model)
        ], 200);
    }
}
