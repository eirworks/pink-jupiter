<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Click;
use Faker\Generator as Faker;

$factory->define(Click::class, function (Faker $faker) {
    return [
        'session' => \Illuminate\Support\Str::random(32),
        'service_id' => $faker->numberBetween(1,15),
    ];
});
