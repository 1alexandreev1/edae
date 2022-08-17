<?php

namespace App\Models;

use App\Models\Model;
use App\Models\News\News;
use App\Models\Recipes\Recipe;

class Tag extends Model
{
    protected $fillable = [
        'name',
        'model_type'
    ];
}
