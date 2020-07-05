<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Category;
use App\Faker\FakeCategory;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
    $faker->addProvider(new FakeCategory($faker));

    $ordering = $faker->randomNumber(2);

    return [
        'name' => $faker->serviceCategories(),
        'slug' => \Illuminate\Support\Str::slug(implode(" ",$faker->words)),
        'image' => '',
        'parent_id' => 0,
        'description' => $faker->paragraph,
        'price' => 1000,
        'ordering' => $ordering,
        'group_order' => $faker->numberBetween(1, 9),
        'type' => Category::TYPE_SERVICE,
    ];
});

$factory->state(Category::class, 'shop', function(Faker $faker) {
    $faker->addProvider(new FakeCategory($faker));

    return [
        'name' => $faker->shoppingCategories(),
        'type' => Category::TYPE_SHOP,
    ];
});
