<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Category;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
    $serviceNames = [
        'Servis', 'Reparasi', "Sewa", "Tutoring", "Perbaikan", "Pembuatan",
    ];
    $serviceObjects = [
        'TV', 'Radio', 'Kulkas', 'AC', 'Mobil', 'Motor', 'Mesin Pabrik', 'Senjata',
        'LCD', 'Buku', "Perangko", "Koleksi", "Majalah", "Matahari", "Kartu Kredit", "Kereta Api",
        "Pesawat Terbang", 'Jembatan', 'Jalan Raya', 'Rel',
    ];

    $ordering = $faker->randomNumber(2);

    return [
        'name' => $faker->randomElement($serviceNames)." ".$faker->randomElement($serviceObjects)." ".$faker->randomNumber(4).' ('.$ordering.')',
        'slug' => \Illuminate\Support\Str::slug(implode(" ",$faker->words)),
        'image' => '',
        'parent_id' => 0,
        'description' => $faker->paragraph,
        'price' => 1000,
        'ordering' => $ordering,
        'group_order' => $faker->numberBetween(1, 9),
    ];
});
