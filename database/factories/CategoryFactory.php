<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Category;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
    return [
        'name' => ucwords($faker->words(3, true)),
        'slug' => \Illuminate\Support\Str::slug(implode(" ",$faker->words)),
        'image' => '',
        'parent_id' => 0,
        'description' => $faker->paragraph,
    ];
});
