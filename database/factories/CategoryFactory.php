<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Category;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
    $serviceNames = [
        'Servis', 'Reparasi', "Sewa", "Tutoring", "Perbaikan", "Pembuatan",
    ];
    $serviceObjects = [
        'TV', 'Radio', 'Kulkas', 'AC', 'Mobil', 'Motor', 'Mesin Pabrik', 'Senjata', 'Wanita',
        'LCD', 'Buku', "Perangko", "Koleksi", "Majalah", "Matahari", "Kartu Kredit", "Kereta Api",
        "Pesawat Terbang", "Marble", 'Jembatan', 'Jalan Raya', 'Rel',
    ];
    return [
        'name' => $faker->randomElement($serviceNames)." ".$faker->randomElement($serviceObjects),
        'slug' => \Illuminate\Support\Str::slug(implode(" ",$faker->words)),
        'image' => '',
        'parent_id' => 0,
        'description' => $faker->paragraph,
        'price' => 1000,
    ];
});
