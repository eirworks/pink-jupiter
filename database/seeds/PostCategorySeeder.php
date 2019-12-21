<?php

use Illuminate\Database\Seeder;

class PostCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\PostCategory::truncate();

        factory(\App\PostCategory::class, 5)->create();
    }
}
