<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Ad;
use Faker\Generator as Faker;

$factory->define(Ad::class, function (Faker $faker) {
    $cityIds = \App\City::take(10)->pluck('id');
    $districtIds = \App\District::take(10)->pluck('id');
    $categoryIds = \App\Category::where('parent_id', 0)->take(10)->pluck('id');
    return [
        'name' => ucwords($faker->sentence),
        'description' => $faker->text,
        'user_id' => 1,
        'city_id' => $faker->randomElement($cityIds),
        'district_id' => $faker->randomElement($districtIds),
        'category_id' => $faker->randomElement($categoryIds),
        'image' => 'users/stock.jpg',
        'price' => 250000,
        'activated' => true,
        'data' => [],
    ];
});
