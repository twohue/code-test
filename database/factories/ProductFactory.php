<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\{Product, Subscription};
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    $subscription = Subscription::inRandomOrder()->limit(1)->first();
    return [
        'name'              => $faker->sentence,
        'description'       => $faker->paragraph,
        'subscription_id'   => $subscription->id,
        'price'             => $faker->numberBetween(1,100),
        'image'             => $faker->imageUrl(200,200)
    ];
});
