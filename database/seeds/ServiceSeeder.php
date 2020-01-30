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
        \App\Ad::truncate();

        factory(\App\Ad::class, 30)->create([
            'user_id' => 2,
        ]);
    }
}
