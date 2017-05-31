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

        Route::get('category/{id}', 'RecipeController@show');
        Route::get('recipes', 'RecipeController@index');
        Route::get('recipe/create', 'RecipeController@create');
        Route::get('recipe/{id}', 'RecipeController@show');

        Route::get('ingredients', 'IngredientController@index');
        Route::get('ingredient/create', 'IngredientController@create');
        Route::get('ingredient/{id}', 'IngredientController@show');

        Route::get('circles', 'CircleController@index');
        Route::get('circle/create', 'CircleController@create');
        Route::get('circle/{circle}', 'CircleController@show');

        Route::get('favourites', 'FavouriteController@index');

        Route::get('calendar', 'CalendarController@index');

        Route::get('event/create', 'CalendarController@createEvent');
        Route::get('event/{id}', 'EventController@show');

        Route::get('shopLists', 'ShopListController@index');
        Route::get('shopList/{id}', 'ShopListController@show');

        Route::get('fridge', 'FridgeController@index');
    });

    Route::post('recipe', 'RecipeController@store');
    Route::post('recipe/create', 'RecipeController@store');
    Route::post('rating/create' , 'RatingController@store');
    Route::post('ingredient/create', 'IngredientController@store');
    Route::post('circle', 'CircleController@store');
    Route::post('circle/{id}', 'CircleController@update');
    Route::post('circle/delete/{id}','CircleController@destroy');
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
        Route::get('searchIngredientsNames/{word}', 'AjaxController@ingredientsNames');
        Route::get('getRecipiesForIngredients', 'FridgeController@getRecipiesForIngredients');
        Route::get('getRecipies', 'RecipeController@getRecipies');
        Route::get('searchAllIngredients', 'AjaxController@searchAllIngredients');

        Route::get('searchAllUsers', 'UserController@searchAllUsers');

        Route::get('eventsForCalendar', 'CalendarController@eventsForCalendar');

        Route::get('getEventUsers/{id}', 'EventController@getUsersForEvent');
        Route::post('removeUserFromEvent', 'EventController@removeUserFromEvent');
    });
});

