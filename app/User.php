<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    public function getRouteKeyName()
    {
        return 'username';
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function video() {
        return $this->hasMany(Video::class);
    }

    public function likes() {
        return $this->hasMany(VideoLike::class);
    }
    public function dislikes() {
        return $this->hasMany(VideoDislike::class);
    }

    public function subscribers(){
        return $this->belongsToMany(User::class, 'subscriptions','channel_id', 'subscriber_id')->withTimestamps();
    }

    public function subscriptions(){
        return $this->belongsToMany(User::class, 'subscriptions',
        'subscriber_id', 'channel_id')->withTimestamps();
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }




}
