<?php

use Illuminate\Database\Seeder;
use App\Models\Recipe;
use Illuminate\Database\QueryException;
use App\Models\Step;
use App\Models\Pivots\IngredientRecipe;

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

            for ($i = 0;$i < 5;$i++) {
                $step = factory(Step::class)->make([
                    'recipe_id' => $recipe->id
                ]);

                repeat_second_query:
                try {
                    $step->save();
                } catch (QueryException $e) {
                    $step = factory(Step::class)->make([
                        'recipe_id' => $recipe->id
                    ]);
                    goto repeat_second_query;
                }
            }

            for ($i = 0;$i < 10;$i++) {
                $ingredient_recipe = factory(IngredientRecipe::class)->make([
                    'recipe_id' => $recipe->id
                ]);

                repeat_third_query:
                try {
                    $ingredient_recipe->save();
                } catch (QueryException $e) {
                    $ingredient_recipe = factory(IngredientRecipe::class)->make([
                        'recipe_id' => $recipe->id
                    ]);
                    goto repeat_third_query;
                }
            }
        }
    }
}
