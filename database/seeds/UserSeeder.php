<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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
            'superadmin' => true,
            'admin_manager' => true,
            'password' => Hash::make('dev'),
        ]);
        $partner = factory(\App\User::class)->state('partner')->create([
            'name' => "Developer (Partner)",
            'email' => 'user1@cc.cc',
            'contact' => '081',
            'password' => Hash::make('dev'),
        ]);
        $partner->transactions()->createMany(
            array_merge(
                factory(\App\UserTransaction::class, 5)->make([
                    'amount' => 50000
                ])->toArray(),
                factory(\App\UserTransaction::class, 5)->make([
                    'amount' => -50000
                ])->toArray()
            )
        );
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
