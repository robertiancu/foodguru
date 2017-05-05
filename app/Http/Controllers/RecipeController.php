<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\Recipe;

class RecipeController extends Controller
{
    /**
     * Return the view with associated data for a recipe.
     *
     * @throws ModelNotFound
     * @return Response
     */
    public function show($id)
    {
        $recipe = [];

        $recipe['recipe'] = Recipe::findOrFail($id);

        return view('recipe', compact('recipe'));
    }

    // TODO 
}
