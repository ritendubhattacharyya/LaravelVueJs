<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App;
use Illuminate\Database\Eloquent\Builder;

class Tweek extends Model
{
    protected $guarded = [];

    public function user() {
        return $this->belongsTo(App\User::class);
    }

    public function like(User $user, $liked = true) {
        $this->likes()->updateOrCreate([
            'user_id' => $user ? $user->id : auth()->user(),
        ], [
            'liked' => $liked,
        ]);
    }

    public function dislike(User $user) {
        return $this->like($user, false);
    }

    public function isLikedBy(User $user) {
//        return $this->likes()->where('user_id', $user->id)->exists();
        return (bool)$user->likes->where('tweek_id', $this->id)->where('liked', true)->count();
    }

    public function isDislikedBy(User $user) {
//        return !$this->likes()->where('user_id', $user->id)->exists();
        return (bool)$user->likes->where('tweek_id', $this->id)->where('liked', false)->count();
    }

    public function likes() {
        return $this->hasMany(Like::class);
    }

    public function scopeWithLikes(Builder $query) {
        $query->leftJoinSub(
            'select tweek_id, sum(liked) likes, sum(!liked) dislikes from likes group by tweek_id',
            'likes',
            'likes.tweek_id',
            'tweeks.id'
        );
    }
}
