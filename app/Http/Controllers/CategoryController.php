<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
     /**
     * Display a listing of the categories.
     *
     * @return Response
     */
    public function index()
    {
        $categories = Category::all();

        return $categories;
    }

    /**
     * Show the form for creating a new category.
     *
     * @return Response
     */
    public function create()
    {
        return 'Category form';
    }

    /**
     * Store a newly created category in storage.
     *
     * @return Response
     */
    public function store()
    {
        $rules = array(
            'name'       => 'required',
            'description' => 'required',
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('categories/create')
                ->withErrors($validator)
                ->withInput();
        } else {
            $category = new Category;
            $category->name        = Input::get('name');
            $category->description = Input::get('description');
            $category->image       = Input::get('image');
            $category->save();

            return Redirect::to('categories');
        }
    }

    /**
     * Display the specified category.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $category = Category::find($id);

        return $category;
    }

    /**
     * Show the form for editing the specified category.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $category = Category::find($id);

        return "Category edit Form";
    }

    /**
     * Update the specified category in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        $rules = array(
            'name'       => 'required',
            'description' => 'required',
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('categories/' . $id . '/edit')
                ->withErrors($validator)
                ->withInput();
        } else {
            
            $category = Category::find(3);
            $category->name        = Input::get('name');
            $category->description = Input::get('description');
            $category->image       = Input::get('image');
            $category->save();

            return Redirect::to('categories');
        }
    }

    /**
     * Remove the specified category from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();

        return Redirect::to('categories');
    }
}
