<?php

use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Service::truncate();

        factory(\App\Service::class, 30)->create([
            'user_id' => 2,
        ]);
    }
}
