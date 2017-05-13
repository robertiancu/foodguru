<?php

use Illuminate\Database\Seeder;
use App\Models\Ingredient;
use App\Models\Misc\IngredientMeta;
use Illuminate\Database\QueryException;

class IngredientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ingredients')->delete();
        DB::table('ingredient_meta')->delete();

        $json = File::get("database/data/ingredients.json");
        $data = json_decode($json);

        foreach ($data as $key=>$obj) {
            $ingredient_id = $key + 1;
            $aliment = $obj->Aliment;
            $calories = (double)$obj->Calorii;
            $proteins = (double)$obj->Proteine;
            $lipids = (double)$obj->Lipide;
            $carbs = (double)$obj->Carbohidrati;
            $fibers = (double)$obj->Fibre;
            DB::statement("INSERT
                INTO ingredients (id, name, image, calories, proteins, lipids, carbs, fibers, description, unit, class, user_id, published, created_at)
                VALUES ($ingredient_id, '$aliment', NULL, $calories, $proteins, $lipids, $carbs, $fibers, NULL, 'g', 2, 1, 1, NOW())");

            //DB::statement("INSERT INTO ingredient_meta (ingredient_id, `key`, `value`, created_at) VALUES ($ingredient_id, 'calorii', $calorii, NOW())");

            //DB::statement("INSERT INTO ingredient_meta (ingredient_id, `key`, `value`, created_at) VALUES ($ingredient_id, 'proteine', $proteine, NOW())");

            //DB::statement("INSERT INTO ingredient_meta (ingredient_id, `key`, `value`, created_at) VALUES ($ingredient_id, 'lipide', $lipide, NOW())");

            //DB::statement("INSERT INTO ingredient_meta (ingredient_id, `key`, `value`, created_at) VALUES ($ingredient_id, 'carbohidrati', $carbohidrati, NOW())");

            //DB::statement("INSERT INTO ingredient_meta (ingredient_id, `key`, `value`, created_at) VALUES ($ingredient_id, 'Fibre', $fibre, NOW())");
            /*$ingredient = factory(Ingredient::class)->make(array(*/
                //'id' => $key + 1 ,
                //'name' => $obj->Aliment,
                //'image' => null,
            //));
            //$ingredientMeta1 = factory(IngredientMeta::class)->make(array(
                //'ingredient_id' => $key + 1,
                //'key' => 'Calorii',
                //'value' => $obj->Calorii,
            //));
            //$ingredientMeta2 = factory(IngredientMeta::class)->make(array(
                //'ingredient_id' => $key + 1,
                //'key' => 'Proteine',
                //'value' => $obj->Proteine,
            //));
            //$ingredientMeta3 = factory(IngredientMeta::class)->make(array(
                //'ingredient_id' => $key + 1,
                //'key' => 'Lipide',
                //'value' => $obj->Lipide,
            //));
            //$ingredientMeta4 = factory(IngredientMeta::class)->make(array(
                //'ingredient_id' => $key + 1,
                //'key' => 'Carbohidrati',
                //'value' => $obj->Carbohidrati,
            //));
            //$ingredientMeta5 = factory(IngredientMeta::class)->make(array(
                //'ingredient_id' => $key + 1,
                //'key' => 'Fibre',
                //'value' => $obj->Fibre,
            //));

            //$ingredient->save();

            //$ingredientMeta1->save();
            //$ingredientMeta2->save();
            //$ingredientMeta3->save();
            //$ingredientMeta4->save();
            /*$ingredientMeta5->save();*/

        }
    }
}
