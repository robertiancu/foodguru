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

    /**
     * Returns recipies by tags like most recent and also returns
     * categories
     *
     * @return Response
     */
    public function index()
    {
        $categories = Category::all();

        $recent_recipies = Recipe::mostRecent()->take(8)->get();

        $best_ratings = DB::select("select re.id, re.name, sum(ra.rating) as total_rating
                                            from recipies re
                                            left join ratings ra on ra.recipe_id = re.id
                                            sort by total_rating DESC
                                            limit 8");

        return view('views.recipes', compact('categories', 'recent_recipies', 'best_ratings'));
    }
}
