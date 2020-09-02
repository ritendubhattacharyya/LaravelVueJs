<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    protected $guarded = [];

    public function product() {
        return $this->belongsToMany(Product::class);
    }
}
