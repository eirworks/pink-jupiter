<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\User::truncate();

        factory(\App\User::class)->state('admin')->create([
            'username' => 'dev',
            'password' => \Illuminate\Support\Facades\Hash::make('dev'),
        ]);
        factory(\App\User::class, 10)->create();
        factory(\App\User::class, 10)->state('partner')->create();
        factory(\App\User::class, 3)->state('admin')->create();
    }
}
