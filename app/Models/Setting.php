<?php

namespace App\Models;

use App\Models\Model;

class Setting extends Model
{
    protected $fillable = [
        'slug',
        'settings',
    ];

    public function getSettingsAttribute($value)
    {
        return json_decode($value);
    }
}
