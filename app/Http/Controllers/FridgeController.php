<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ingredient;
use App\Models\Recipe;
use App\Models\Pivots\IngredientRecipe;
use App\Transformers\IngredientTransformer;

class FridgeController extends Controller
{
    /**
     * Return view with the fridge feature.
     *
     * @return Response
     */
    public function index()
    {
        $sidebar_items = $this->getSidebarMenuItems();
        return view('views.fridge', compact('sidebar_items'));
    }

    /**
     * Get two types of recipes listing for given ingredients.
     *
     * @return array
     */
    public function getRecipiesForIngredients(Request $request)
    {
        //Get an array of ingredients (strings)
        $ingredientsNames = $request->input('ingrediente');

        //Find ingredients object after name
        $ingredients = Ingredient::query();
        foreach($ingredientsNames as $ingredientName){
            $ingredients->orWhere('name', 'LIKE', $ingredientName);
        }
        $ingredients = $ingredients->distinct()->get();

        //If we don't find any ingredient, return []
        if($ingredients->isEmpty())
            return [];

        //Find ingredient_recipes after id of ingredients
        $ingredientsRecipes = IngredientRecipe::query();
        foreach($ingredients as $ingredient)
        {
            $ingredientsRecipes->orWhere('ingredient_id', 'LIKE', $ingredient->id);
        }
        $ingredientsRecipes = $ingredientsRecipes->get();

        //Algorithm for sorting the recipes after number of ocurrences
        $count = array();
        foreach ($ingredientsRecipes as $key) {
            if (!isset($count[$key->recipe_id])) $count[$key->recipe_id] = 0;
            $count[$key->recipe_id]++;
        }
        $count2 = $count;

        //Reverse $count array
        arsort($count, SORT_NUMERIC);

        $sortedIngRec = array();
        foreach ($count as $key=>$count) $sortedIngRec[] = $key;

        //Get the recipes which have ONLY ingredients from first array
        $onlyIngRec = array();

        foreach($sortedIngRec as $key)
        {
            $numberOfIngredients = IngredientRecipe::where('recipe_id',$key)->get();
            $numberOfIngredients = $numberOfIngredients->count();
            if($numberOfIngredients == $count2[$key])
                $onlyIngRec[] = $key;
        }

        $onlyIngRecResults = array();

        foreach($onlyIngRec as $key)
            $onlyIngRecResults[] = Recipe::find($key);

        return $onlyIngRecResults;
    }
}
