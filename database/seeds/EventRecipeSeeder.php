<?php

use Illuminate\Database\Seeder;
use App\Models\Misc\EventRecipe;
use Illuminate\Database\QueryException;

class EventRecipeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $event_recipies = factory(EventRecipe::class, 100)->make();
        foreach ($event_recipies as $event_recipe) {
            repeat_query:
            try {
                $event_recipe->save();
            } catch (QueryException $e) {
                $event_recipe = factory(EventRecipe::class)->make();
                goto repeat_query;
            }
        }
    }
}
