<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rating;

class RatingController extends Controller
{
     /**
     * Display listing of all Ratings ( pretty much useless )
     *
     * @return Response
     */
    public function index()
    {
        $ratings = Rating::all();
        return $ratings;
    }

     /**
     * Display listing of all Ratings for a given recipe
     *
     * @return Response
     * @param int recipe_id
     */
    public function recipeRatings($recipe_id)
    {
        $ratings = Rating::where('recipe_id','=',$recipe_id)->get();
        return $ratings;
    }

    /**
    *Display listing of all Ratings given by the AUTH user
	*
	* @return response
	*/
    public function userRatings()
    {
		$user = Auth::user();
		$ratings = $user->ratings();
		return $ratings;
    }

    /**
     * Show the form for creating a new rating.
     *
     * @return Response
     */
    public function create()
    {
        return 'Rating creation form';
    }

     /**
     * Stores the new rating created.
     * User needs to be AUTH
     *
     * @return Response
     */
     public function store()
    {
        $rules = array(

        	'user_id'	=> 'required|numeric',
        	'recipe_id'	=> 'required|numeric',
            'rating' => 'required|numeric',
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('ratings/create')
                ->withErrors($validator)
                ->withInput();
        } else {
            $rating = new Rating;
            $rating->user_id       = Auth::user();
            $rating->recipe_id     = Input::get('recipe_id');
            $rating->rating        = Input::get('rating');
            $rating->save();

            return Redirect::to('ratings');
        }
    }

     /**
     * Shows the rating with the specified id.
     *
     * @return Response
     */
    public function show($id)
    {
        $rating = Rating::find($id);
        return $rating;
    }


     /**
     * Updates a rating.
     * User needs to be AUTH
     *
     * @return Response
     */
     public function update($id)
    {
        $rules = array(
            'rating' => 'required|numeric',
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('ratings/'.$id.'/edit')
                ->withErrors($validator)
                ->withInput();
        } else {
            $rating = Rating::find($id);
            $rating->rating        = Input::get('rating');
            $rating->save();

            return Redirect::to('ratings');
        }
    }

     /**
     * Remove the specified rating from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
    	$uid = Auth::user()->id;
        $rating = Rating::find($id)->where('user_id',$uid)->first();	
        
		// You can only delete a rating that belongs to you! 

        if($rating)
        	$rating->delete();

        return Redirect::to('ratings');
    }
}
