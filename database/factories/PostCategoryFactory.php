<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\PostCategory;
use Faker\Generator as Faker;

$factory->define(PostCategory::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'slug' => \Illuminate\Support\Str::slug($faker->word),
    ];
});
