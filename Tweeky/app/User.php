<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'avatar', 'bio'
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

    public function follow(User $user) {
        return $this->follows()->save($user);
    }

    public function unfollow(User $user) {
        return $this->follows()->detach($user);
    }

    public function follows() {
        return $this->belongsToMany(User::class, 'follows', 'user_id', 'following_user_id');
    }

    public function tweeks() {
        return $this->hasMany(Tweek::class);
    }

    public function getUserAvatar(User $user) {
        return ($user->avatar) ? '/storage/'.$user->avatar : '/storage/avatars/default.png';
    }

    public function likes() {
        return $this->hasMany(Like::class);
    }
}
