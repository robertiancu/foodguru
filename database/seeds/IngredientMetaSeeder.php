<?php

use Illuminate\Database\Seeder;
use App\Models\Misc\IngredientMeta;
use Illuminate\Database\QueryException;

class IngredientMetaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ingredient_metas = factory(IngredientMeta::class, 500)->make();
        foreach ($ingredient_metas as $ingredient_meta) {
            repeat_query:
            try {
                $ingredient_meta->save();
            } catch (QueryException $e) {
                $ingredient_meta = factory(IngredientMeta::class)->make();
                goto repeat_query;
            }
        }
    }
}
