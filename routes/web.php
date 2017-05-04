<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => ['web', 'auth']], function () {
    Route::group(['prefix' => 'view/'], function() {
        Route::get('home', 'HomeController@index');

        Route::get('recipes', 'RecipeController@index');
        Route::get('recipe/{id}', 'RecipeController@show');

        Route::get('ingredients', 'RecipeController@index');
        Route::get('ingredient/{id}', 'RecipeController@show');

        Route::get('circles', 'CircleController@index');
        Route::get('circle/{id}', 'RecipeController@show');

        Route::get('calendar', 'CalendarController@index');

        Route::get('shopLists', 'ShopListController@index');
        Route::get('shopList/{id}', 'ShopListController@show');

        Route::get('fridge', 'FridgeController@index');
    });

    Route::post('recipe/{id}', 'RecipeController@store');
    Route::post('ingredient/{id}', 'RecipeController@store');
    Route::post('circle/{id}', 'CircleController@store');
    Route::post('addCalendarEvent', 'CalendarController@addEvent');

    Route::group(['prefix' => 'image/'], function() {
        Route::get('user/default', 'ImageController@defaultUser');
        Route::get('user/{id}', 'ImageController@userImage');
        Route::get('recipe/default', 'ImageController@defaultRecipe');
        Route::get('recipe/{id}', 'ImageController@recipeImage');
        Route::get('ingredient/default', 'ImageController@defaultIngredient');
        Route::get('ingredient/{id}', 'ImageController@ingredientImage');

        Route::get('base/sidebarIcon/{img}', 'ImageController@sidebarIcon');
    });

    Route::group(['prefix' => 'ajax/'], function() {
        Route::get('searchRecipeHints/{word}', 'AjaxController@searchRecipeHints');
        Route::get('searchIngredientHints/{word}', 'AjaxController@searchIngredientHints');
    });
});

