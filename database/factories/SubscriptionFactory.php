<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Subscription;
use Faker\Generator as Faker;

$factory->define(Subscription::class, function (Faker $faker) {
    return [
        'name'              => $faker->sentence,
        'description'       => $faker->paragraph,
        'price'             => $faker->numberBetween(199,899),
        'featured'          => $faker->numberBetween(0,1)
    ];
});
