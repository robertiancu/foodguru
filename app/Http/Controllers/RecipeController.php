<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\Recipe;
use App\Models\Category;
use App\Models\Step;
use App\Models\Rating;
use App\Models\Ingredient;
use App\Models\Pivots\IngredientRecipe;
use Illuminate\Support\Facades\Input;
use Auth;

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
        $sidebar_items = $this->getSidebarMenuItems();
        $recipe= Recipe::findOrFail($id);
        $rating = [];
        $rating['myRating'] = Rating::where('recipe_id',$recipe->id)->where('user_id',Auth::id())->first();
        
        if($rating['myRating']==null)
            $rating['myRating'] = 0;
        else
            $rating['myRating']=$rating['myRating']->rating;

        $rating['ratingAvg']= Rating::where('recipe_id',$recipe->id)->avg('rating');
        $rating['C'] = Rating::where('recipe_id',$recipe->id)->count();
        $rating['ratingAvg'] = number_format($rating['ratingAvg'],1);
        if($rating['ratingAvg'] == 0)
            $rating['ratingAvg']="No rating added yet";
        $steps = Step::where('recipe_id',$recipe->id)->orderBy('step_number')->get();

        $ingredientsRecipe = IngredientRecipe::where('recipe_id',$id)->get();

        $ingredients = [];
        $nutrition = [];

        $nutrition['calories'] = 0;
        $nutrition['proteins'] = 0;
        $nutrition['lipids'] = 0;
        $nutrition['carbs'] = 0;
        $nutrition['fibers'] = 0;
        $nutrition['grams'] = 0;

        foreach($ingredientsRecipe as $ingredient)
        {

            $ing = [];

            $ingredientModel = Ingredient::where('id',$ingredient->ingredient_id)->first();

            $ing['name'] = $ingredientModel->name;
            $ing['quantity'] = $ingredient->quantity;
            $ing['description'] = $ingredient->detail;
            $ing['unit'] = $ingredientModel->unit;
            array_push($ingredients,$ing);

            $nutrition['calories'] += $ingredientModel->calories * $ingredient->quantity / 100;
            $nutrition['proteins'] += $ingredientModel->proteins * $ingredient->quantity/ 100;
            $nutrition['lipids'] += $ingredientModel->lipids * $ingredient->quantity / 100;
            $nutrition['carbs'] += $ingredientModel->carbs * $ingredient->quantity / 100;
            $nutrition['fibers'] += $ingredientModel->fibers * $ingredient->quantity / 100;
            $nutrition['grams'] += $ingredient->quantity;
        }

            $nutrition['calories'] = number_format($nutrition['calories'],1,'.','');
            $nutrition['proteins'] = number_format($nutrition['proteins'],1,'.','');
            $nutrition['lipids'] = number_format($nutrition['lipids'],1,'.','');
            $nutrition['carbs'] = number_format($nutrition['carbs'],1,'.','');
            $nutrition['fibers'] = number_format($nutrition['fibers'],1,'.','');

        return view('views.show.recipe', compact('sidebar_items','recipe','steps','rating','ingredients','nutrition'));
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

        // foreach ($request->input('steps') as $step_number => $step_content) {
        //     $rules['step.' . $step_number . '.content'] = 'required|string';
        // }

        return Validator::make($request->all(), $rules);
    }

    /**
     * Store the recipe in database
     *
     * @return void
     */
    public function store(Request $request)
    {
        // $validator = $this->validator($request);

        // if ($validator->fails()) {
        //     return redirect('recipe/create')
        //         ->withErrors($validator)
        //         ->withInput();
        // }

        $recipe = new Recipe;
        $recipe->category_id = Category::where('name',$request->input('category'))->first()->id;
        $recipe->name = $request->input('name');
        $file = Input::file('image');

            if($file)
            {   
            $filename = Recipe::orderBy('id','desc')->first()->id+1;
            $extension = $file->getMimeType();
            $extension = explode("/", $extension)[1];
            $new_image_name = ((string) $filename) . "." . $extension;
            $file = $file->move(public_path() . '/images/recipe_images/' , $new_image_name);
            $image_path = '/images/recipe_images/' . $new_image_name;
            $recipe->image = $image_path;
            }  
            else
                {
                    $recipe->image = null;
                    return (Input::file('image'));
                }
        $recipe->description = $request->input('description');
        $recipe->time = $request->input('time');
        $recipe->difficulty = $request->input('difficulty');
        $recipe->published = (strcmp($request->input('public'),'yes')==0);
        $recipe->user_id = Auth::id();
        $recipe->save();

        $stepNumber = 1;
        $step = "step-". $stepNumber;
        while($request->input($step)!=null)
        {
            $newStep = new Step;
            $newStep->step_number = $stepNumber;
            $newStep->content = $request->input($step);
            $newStep->recipe_id = $recipe->id;
            $newStep->save();

            $stepNumber ++;
            $step = "step-" . $stepNumber;
        }

        $ingNumber = 1;
        $ingName = 'name-' . $ingNumber;
        $ingQuantity = 'quantity-' . $ingNumber;
        $ingDescription  = 'description-' . $ingNumber;
        while($request->input($ingName)!=null)
        {
            $ingred = new IngredientRecipe;
            $ingred->detail = $request->input($ingDescription);
            $ingred->ingredient_id = Ingredient::where('name',$request->input($ingName))->first()->id;
            $ingred->recipe_id = $recipe->id;
            $ingred->quantity = $request->input($ingQuantity);
            $ingred->save();

        $ingNumber ++;
        $ingName = 'name-' . $ingNumber;
        $ingQuantity = 'quantity-' . $ingNumber;
        $ingDescription  = 'description-' . $ingNumber;
        }

        return redirect("/view/recipe/" . (string)$recipe->id);
    }

    public function create()
    {
        $sidebar_items = $this->getSidebarMenuItems();
        return view("views.create.recipe", compact('sidebar_items'));
    }


    public function getRecipies(Request $request)
    {
        $recipes =  Recipe::orderBy('created_at','desc')->limit(9)
                            ->offset($request->i * 9)->get();
        return $recipes;
    }

}
