<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Ad;
use App\Faker\FakeCategory;
use Faker\Generator as Faker;

$factory->define(Ad::class, function (Faker $faker) {

    $faker->addProvider(new FakeCategory($faker));

    $cityIds = \App\City::take(10)->pluck('id');
    $districtIds = \App\District::take(10)->pluck('id');
    $categoryIds = \App\Category::where('parent_id', 0)->where('type', \App\Category::TYPE_SERVICE)->pluck('id');

    return [
        'name' => $faker->serviceCategories(),
        'description' => $faker->realText(),
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

$factory->state(Ad::class, 'shop', function(Faker $faker) {
    $categoryIds = \App\Category::where('parent_id', 0)->where('type', \App\Category::TYPE_SHOP)->pluck('id');

    return [
        'name' => $faker->shoppingCategories(),
        'category_id' => $faker->randomElement($categoryIds),
    ];
});
