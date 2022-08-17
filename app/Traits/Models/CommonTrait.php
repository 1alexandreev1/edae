<?php

namespace App\Traits\Models;

use App\Models\Comment;
use App\Models\Like;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

trait CommonTrait
{
    public function getPublishAttribute($value)
    {
        return Carbon::parse($value)->format('d.m.Y H:i');
    }

    public function setPublishAttribute($value)
    {
        $this->attributes['publish'] = Carbon::parse($value);
    }

    public function getLikesCountAttribute()
    {
        return $this->likes->where('like', true)->count();
    }

    public function getDislikesCountAttribute()
    {
        return $this->likes->where('like', false)->count();
    }

    public function likes()
    {
        return $this->morphMany(Like::class, 'model');
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'model');
    }

    public function like()
    {
        return $this->morphOne(Like::class, 'model')->whereUserId(Auth::id())->withDefault();
    }

    public function getReplaceField($field = 'text', $empty = false)
    {
        $medias = $this->getMedia('');
        $text = $this->$field;
        foreach ($medias as $media) {
            if ($empty)
                $onReplace = '';
            else
                $onReplace = view('edae.mime-type', compact('media'))->render();

            $text = Str::replace($media->getCustomProperty('code'), $onReplace, $text);
        }
        $text = Str::of($text)->replaceMatches('/\$CODE[0-9]+\$/', '');
        return $text;
    }
}
