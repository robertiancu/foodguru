<?php

use Illuminate\Database\Seeder;
use App\Models\Recipe;
use Illuminate\Database\QueryException;

class RecipesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $recipes = factory(Recipe::class, 50)->make();
        foreach ($recipes as $recipe) {
            repeat_query:
            try {
                $recipe->save();
            } catch (QueryException $e) {
                $recipe = factory(Recipe::class)->make();
                goto repeat_query;
            }
        }
    }
}
