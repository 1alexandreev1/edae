<?php

namespace App\Models;

use App\Models\Model;
use Carbon\Carbon;

class Comment extends Model
{
    protected $fillable = [
        'user_id',
        'text',
        'parrent_id',
        'reply_to'
    ];

    protected $with = [
        'user.media'
    ];

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d.m.Y H:i:s');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
