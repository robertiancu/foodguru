<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ingredient;
use App\Models\Misc\IngredientMeta;

class IngredientController extends Controller
{
    /**
     * Display a listing of the ingredients.
     *
     * @return Response
     */
    public function index()
    {
        $ingredients = Ingredient::all();

        return $ingredients;
    }

    /**
     * Show the form for creating a new ingredient.
     *
     * @return Response
     */
    public function create()
    {
        return 'Form for creating ingredient';
    }

    /**
     * Store a newly created ingredient in storage.
     *
     * @return Response
     */
    public function store()
    {
        $rules = array(
            'name'       => 'required',
            'description' => 'required',
            'unit' => 'required',
            'class' => 'required|numeric',
            'proteins' => 'required|numeric',
            'carbohydrates' => 'required|numeric',
            'fats' => 'required|numeric',
            'calories' => 'required|numeric',
            'fibers' => 'required|numeric',
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('ingredients/create')
                ->withErrors($validator)
                ->withInput();
        } else {
            $ingredient = new Ingredient;
            $ingredient->name        = Input::get('name');
            $ingredient->description = Input::get('description');
            $ingredient->unit        = Input::get('unit');
            $ingredient->class       = Input::get('class');
            $ingredient->save();

            $metaElements['Calorii'] = "calories";
            $metaElements['Proteine'] = "proteins";
            $metaElements['Lipide'] = "fats";
            $metaElements['Carbohidrati'] = "carbohydrates";
            $metaElements['Fibre'] = "fibers";

            foreach($metaElements as $key => $meta) {
                $ingredientMeta = new IngredientMeta;
                $ingredientMeta->ingredient_id = $ingredient->id();
                $ingredientMeta->key           = $key;
                $ingredientMeta->value         = Input::get($meta);
                $ingredientMeta->save();
            }

            return Redirect::to('ingredients');
        }
    }

    /**
     * Display the specified ingredient.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $ingredient = Ingredient::find($id);

        return $ingredient;
    }

    /**
     * Show the form for editing the specified ingredient.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $ingredient = Ingredient::find($id);

        return "Form for editing ingredient";
    }

    /**
     * Update the specified ingredient in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        $rules = array(
            'name'       => 'required',
            'description' => 'required',
            'unit' => 'required',
            'class' => 'required|numeric',
            'proteins' => 'required|numeric',
            'carbohydrates' => 'required|numeric',
            'fats' => 'required|numeric',
            'calories' => 'required|numeric',
            'fibers' => 'required|numeric',
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('ingredients/' . $id . '/edit')
                ->withErrors($validator)
                ->withInput();
        } else {
            $ingredient = new Ingredient;
            $ingredient->name        = Input::get('name');
            $ingredient->description = Input::get('description');
            $ingredient->unit        = Input::get('unit');
            $ingredient->class       = Input::get('class');
            $ingredient->save();

            $metaElements['Calorii'] = "calories";
            $metaElements['Proteine'] = "proteins";
            $metaElements['Lipide'] = "fats";
            $metaElements['Carbohidrati'] = "carbohydrates";
            $metaElements['Fibre'] = "fibers";

            foreach($metaElements as $key => $meta) {
                $ingredientMeta = new IngredientMeta;
                $ingredientMeta->ingredient_id = $ingredient->id();
                $ingredientMeta->key           = $key;
                $ingredientMeta->value         = Input::get($meta);
                $ingredientMeta->save();
            }

            return Redirect::to('ingredients');
        }
    }

    /**
     * Remove the specified ingredient from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $ingredient = Ingredient::find($id);
        $ingredient->delete();

        return Redirect::to('ingredients');
    }
}
