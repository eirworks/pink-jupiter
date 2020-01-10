<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'business_name' => $faker->company,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => \Illuminate\Support\Facades\Hash::make("123456"),
        'remember_token' => Str::random(10),
        'city_id' => 1100 + $faker->numberBetween(1, 9),
        'balance' => 0,
        'contact' => $faker->e164PhoneNumber,
        'contact_telegram' => $faker->userName,
        'contact_whatsapp' => $faker->e164PhoneNumber,
        'description' => $faker->paragraph,
        'address' => $faker->address,
        'district' => $faker->city,
        'village' => $faker->city,
        'image' => 'users/stock.jpg',
        'id_card_image' => '',
        'data' => [],
        'open_hours' => [],
        'admin_manager' => false,
        'visitors' => 0,
    ];
});

$factory->state(User::class, 'admin', function(Faker $faker) {
    return [
        'type' => User::TYPE_ADMIN,
    ];
});

$factory->state(User::class, 'partner', function(Faker $faker) {
    return [
        'type' => User::TYPE_PARTNER,
        'balance' => 10000,
    ];
});

$factory->state(User::class, 'pending', function(Faker $faker) {
    return [
        'type' => User::TYPE_PARTNER,
        'balance' => 0,
        'activated' => false,
    ];
});
