<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favourite;
use Illuminate\Validation\Rule;
use App\Models\Recipe;


class FavouriteController extends Controller
{ 

    public function index(){
        $favourites = auth()->user()->favourites;
        $recipies = $favourites->map(function ($item,$key){
                    return $item->recipe;
                });

        return view('favourites.index',compact('recipies'));
    }

    public function create(){
        return view('favourites.create');
    }

    public function store(){
            $this->validate(request(),[
            'recipe_id' => [
                'required',
                Rule::in(Recipe::pluck('id')->toArray())
            ]
        ]);
        
        $favourite = new Favourite;
        $favourite->recipe_id = request('recipe_id');
        $favourite->user_id = auth()->user()->id;

        $favourite->save();
        
        return view('favourites.index');
    }

    public function destroy(Favourite $favourite){
        $favourite->delete();

        return view('favourites.index');
    }

}
