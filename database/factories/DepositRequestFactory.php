<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\DepositRequest;
use Faker\Generator as Faker;

$factory->define(DepositRequest::class, function (Faker $faker) {
    return [
        'user_id' => 1,
        'destination' => 'Orchid Bank 8008135 Hang Onn Tai',
        'bank_name' => $faker->firstNameFemale." Bank",
        'bank_account' => $faker->bankAccountNumber,
        'bank_account_name' => $faker->name,
        'amount' => 100000,
    ];
});
