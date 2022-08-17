<?php

namespace App\Models;

use App\Models\Model;

class Like extends Model
{
    protected $fillable = [
        'user_id',
        'like',
    ];

    public function likeable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
