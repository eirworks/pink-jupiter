<?php

use App\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::truncate();
        DB::table('category_user')->truncate();

        factory(Category::class, 10)->create();
        factory(Category::class, 10)->state('shop')->create();
    }
}
