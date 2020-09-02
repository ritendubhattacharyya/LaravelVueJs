<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Product::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'brand' => $faker->word,
        'processor' => $faker->word,
        'ram' => $faker->word,
        'harddisk' => $faker->word,
        'graphicscard' => $faker->word,
        'weight' => $faker->randomDigit,
        'size' => $faker->randomDigit,
        'mrp' => $faker->randomNumber(5),
        'offer' => $faker->randomNumber(5),
        'qty' => $faker->randomDigit
    ];
});
