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
            'name' => 'Developer (Admin)',
            'email' => 'dev@cc.cc',
            'password' => \Illuminate\Support\Facades\Hash::make('dev'),
        ]);
        factory(\App\User::class)->state('partner')->create([
            'name' => "Developer (Partner)",
            'email' => 'user1@cc.cc',
            'password' => \Illuminate\Support\Facades\Hash::make('dev'),
        ]);
        factory(\App\User::class, 10)->create();
        factory(\App\User::class, 5)->state('partner')->create();
        factory(\App\User::class, 5)->state('partner')->create([
            'activated' => true,
            'verified' => true,
        ]);
        factory(\App\User::class, 3)->state('admin')->create();
        factory(\App\User::class, 3)->state('pending')->create();
    }
}
