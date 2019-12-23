<?php

use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Post::truncate();

        factory(\App\Post::class, 5)->state('page')->create();
        factory(\App\Post::class, 5)->create();
        factory(\App\Post::class, 2)->state('draft')->create();
    }
}
