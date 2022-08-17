<?php

namespace App\Http\Controllers\Searches;

use App\Http\Controllers\BaseController;
use App\Http\Requests\SearchRequest;
use App\Services\Searches\SearchService;

class SearchController extends BaseController
{
    public $service;

    function __construct(SearchService $service)
    {
        $this->service = $service;
    }

    public function search(SearchRequest $request)
    {
        return $this->service->search($request->q);
    }
}
