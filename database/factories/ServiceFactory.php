<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Service;
use Faker\Generator as Faker;

$factory->define(Service::class, function (Faker $faker) {
    $cityIds = \App\City::take(10)->pluck('id');
    $categoryIds = \App\Category::where('parent_id', 0)->take(10)->pluck('id');
    return [
        'name' => ucwords($faker->sentence),
        'description' => $faker->text,
        'user_id' => 1,
        'city_id' => $faker->randomElement($cityIds),
        'category_id' => $faker->randomElement($categoryIds),
        'image' => 'users/stock.jpg',
        'price' => 250000,
        'activated' => true,
        'data' => [],
    ];
});
