<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'user_id' => 1,
        'title' => $faker->sentence,
        'slug' => \Illuminate\Support\Str::slug($faker->words(3, true)),
        'content' => $faker->realText(),
        'published_at' => now()->subHour()->toDateTimeString(),
    ];
});

$factory->state(Post::class, 'draft', function(Faker $faker) {
    return [
        'published_at' => null,
    ];
});
