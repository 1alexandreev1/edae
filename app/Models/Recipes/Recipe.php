<?php

namespace App\Models\Recipes;

use App\Models\Model;
use App\Models\Tag;
use App\Traits\Models\CommonTrait;

class Recipe extends Model
{
    use CommonTrait;

    protected $fillable = [
        'name',
        'sub_url',
        'description',
        'ingredients',
        'last_code',
        'user_id',
        'views',
        'publish',
    ];

    // для поиска по связи
    protected $searchable = [
        /**
         * Columns and their priority in search results.
         * Columns with higher values are more important.
         * Columns with equal values have equal importance.
         *
         * @var array
         */
        'columns' => [
            'name' => 1,
            'ingredients' => 1,
            'description' => 1,

            // 'users.name' => 10,
            // 'profiles.username' => 5,
            // 'profiles.bio' => 3,
            // 'profiles.country' => 2,
            // 'profiles.city' => 1,
        ],
        // 'joins' => [
        //     'profiles' => ['users.id', 'profiles.user_id'],
        // ],
    ];


    protected $with = [
        'tags'
    ];

    public function getIngredientsAttribute($value)
    {
        return json_decode($value, true);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'recipe_tags');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'recipe_categories');
    }
}
