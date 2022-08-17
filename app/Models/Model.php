<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model as BaseModel;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use App\Models\User;
use Nicolaslopezj\Searchable\SearchableTrait;

class Model extends BaseModel implements HasMedia
{
    use HasFactory, InteractsWithMedia, SearchableTrait;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
