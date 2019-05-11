<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    public function getRouteKeyName()
    {
        return 'slug';
    }
    public function user() {
        return $this->belongsTo(User::class);
    }

    public function likes() {
        return $this->hasMany(VideoLike::class);
    }

    public function dislikes() {
        return $this->hasMany(VideoDislike::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }
}
