<?php

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Category::truncate();
        \Illuminate\Support\Facades\DB::table('category_user')->truncate();

        $cats = factory(\App\Category::class, 3)->create()->each(function($cat) {
            factory(\App\Category::class, 2)->create([
                'parent_id' => $cat->id,
            ]);
        });

        $users = \App\User::get();
        if ($users)
        {
            $users->each(function($user) use($cats) {
                $user->categories()->sync([
                    1 => [
                        'price' => 50000,
                        'description' => "My Service",
                    ],
                    2 => [
                        'price' => 10000,
                        'description' => "My Service",
                    ]
                ]);
            });
        }
    }
}
