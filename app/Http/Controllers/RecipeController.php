<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\Recipe;
use App\Models\Category;

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

        $sidebar_items = $this->getSidebarMenuItems();

        //$best_ratings = DB::select("select re.id, re.name, sum(ra.rating) as total_rating
            //from recipies re
            //left join ratings ra on ra.recipe_id = re.id
            //sort by total_rating DESC
            //limit 8");

        return view('views.recipes', compact('categories', 'recent_recipies', 'sidebar_items'));
    }

    /**
     * Validate the data from request.
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function validator(Request $request)
    {
        $rules = [
            'name' => 'required|string|max:50',
            'description' => 'required|string',
            'category_id' => 'required|numeric|exists:categories.id',
            'image' => 'max:8000|dimensions:min_width=20,min_height=20,max_width=4000,max_height=4000|mimes:jpeg,jpg,png',
            'time' => 'required|numeric',
            'dificulty' => 'required|min:1|max:10',
            'user_id' => 'required|numeric|exists:users.id',
            'published' => 'required|boolean'
        ];

        foreach ($request->input('steps') as $step_number => $step_content) {
            $rules['step.' . $step_number . '.content'] = 'required|string';
        }

        return Validator::make($request->all(), $rules);
    }

    /**
     * Store the recipe in database
     *
     * @return void
     */
    public function store(Request $request)
    {
        $validator = $this->validator($request);

        if ($validator->fails()) {
            return redirect('recipe/create')
                ->withErrors($validator)
                ->withInput();
        }

        $recipe = new Recipe;
        $recipe->category_id = $request->input('category_id');
        $recipe->name = $request->input('name');
        $recipe->image = $request->input('name');

        return redirect("/view/recipe/" . (string)$recipe->id);
    }

}
