<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;
use App\Post;
use App\User; 

$factory->define(Post::class, function (Faker $faker) {
    return [
        'title' => $faker->text(40),
        'body' => $faker->text(255),
        'user_id' => factory(User::class)
    ];
});
