<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Blog;
use Faker\Generator as Faker;

$factory->define(Blog::class, function (Faker $faker) {
    return [
        'title' => $faker->text(50),
        'body' => $faker->text(255),
        'author' => $faker->text(50),
        'category' => $faker->text(100)
    ];
});
