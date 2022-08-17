<?php

namespace App\Http\Controllers\Recipe;

use App\Http\Controllers\Controller;
use App\Http\Requests\RecipeRequest;
use App\Models\Recipes\Recipe;
use Illuminate\Http\Request;
use App\Services\Recipe\RecipeService as Service;

class RecipeController extends Controller
{
    function __construct(Service $service)
    {
        parent::__construct($service);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function show(Recipe $recipe)
    {
        return $this->service->edit($recipe, true);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RecipeRequest $request)
    {
        return $this->service->store($request);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function edit(Recipe $recipe)
    {
        return $this->service->edit($recipe);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function update(Recipe $recipe, RecipeRequest $request)
    {
        return $this->service->update($recipe, $request);
    }
}
