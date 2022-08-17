<?php

namespace App\Http\Controllers\References;

use App\Http\Controllers\Controller;
use App\Models\Categories\Category;
use App\Services\References\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    function __construct(CategoryService $service)
    {
        parent::__construct($service);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->service->store($request);
    }

    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  \App\Models\News  $news
    //  * @return \Illuminate\Http\Response
    //  */
    // public function show(Category $category)
    // {
    //     return $this->service->edit($category, true);
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return $this->service->edit($category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function update(Category $category, Request $request)
    {
        return $this->service->update($category, $request);
    }
}
