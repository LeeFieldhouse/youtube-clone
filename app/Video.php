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
}
