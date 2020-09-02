<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = [];

    public function attributes() {
        return $this->belongsToMany(Attribute::class);
    }

    public function products() {
        return $this->hasMany(Product::class);
    }
}
