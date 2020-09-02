<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];

    public function getImagePath() {
        return '/img/default.jpeg';
    }

    public function scopeWithCartQty(Builder $query) {
        $query->leftJoinSub(
            "SELECT carts.qty AS cartQty, user_id, product_id FROM carts",
            'carts',
            'carts.product_id',
            'products.id'
        );
    }

    public function getAvatarPath() {
        return ($this->avatar) ? '/storage/'.$this->avatar : '/img/default.jpeg';
    }

    public function category() {
        return $this->hasOne(Category::class);
    }

    public function details() {
        return $this->belongsToMany(Detail::class);
    }

}
