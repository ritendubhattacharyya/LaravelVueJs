<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Tweek;
use Faker\Generator as Faker;

$factory->define(Tweek::class, function (Faker $faker) {
    return [
        'user_id' => factory(App\User::class),
        'body' => $faker->sentence
    ];
});
