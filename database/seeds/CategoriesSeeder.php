<?php

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Database\QueryException;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = factory(Category::class, 5)->make();
        foreach ($categories as $category) {
            repeat_query:
            try {
                $category->save();
            } catch (QueryException $e) {
                $category = factory(Category::class)->make();
                goto repeat_query;
            }
        }
    }
}
