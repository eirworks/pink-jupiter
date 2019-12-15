<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\UserTransaction;
use Faker\Generator as Faker;

$factory->define(UserTransaction::class, function (Faker $faker) {
    return [
        'user_id' => 1,
        'type' => UserTransaction::TYPE_DEPOSIT,
        'amount' => 50000,
        'info' => "Top Up",
    ];
});
