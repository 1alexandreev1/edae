<?php

namespace App\Services\Searches;

use App\Models\News\News;
use App\Models\Recipes\Recipe;

class SearchService
{
    public $route = 'search';
    public $template = 'site.search.';
    public $translation = 'search.';

    function search($q)
    {
        $models = $this->getModelsForSearch();
        $searchData = [];
        if (!is_null($q) || !empty($q)) {
            foreach ($models as $model => $modul) {
                $data = $model::search($q)->get($modul['fillable']);
                if ($data->isNotEmpty()) {
                    $searchData[] = (object)[
                        'modul' => $modul['modul'],
                        'name' => $modul['show'],
                        'data' => $data
                    ];
                }
            }
        }
        return view($this->template . 'index')->with([
            'searchData' => $searchData,
            'q' => $q
        ]);
    }

    private function getModelsForSearch()
    {
        return [
            Recipe::class => [
                'modul' => 'recipes.',
                'fillable' => ['id', 'name'],
                'show' => 'name'
            ],
            News::class => [
                'modul' => 'news.',
                'fillable' => ['id', 'name'],
                'show' => 'name'
            ],
        ];
    }
}
