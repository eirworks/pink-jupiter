<?php

use Illuminate\Database\Seeder;

class DepositSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\DepositRequest::truncate();

        factory(\App\DepositRequest::class, 15)->create();
        factory(\App\DepositRequest::class, 15)->create([
            'confirmed' => now()->subHour()->toDateTimeString(),
        ]);
    }
}
