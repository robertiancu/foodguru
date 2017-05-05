<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Circle;
use App\Models\User;

class CircleController extends Controller
{
    
    /**
     * GET /circles  --  user's circles
     * GET /circles/search?page=...  --  search all circles
     * GET /circles/{circle_id}  --  show a circle
     * GET /circles/{circle_id}?post=...  --  show post details
     * GET /circles/create  --  create a circle
     * POST /circles  --  store circle
     * POST /circles/{circle_id}  --  post on a circle
     * POST /circles/{circle_id}?post=...  --  comment on a post
     */
    
    
    public function index(){
        $circles = auth()->user()->circles->paginate(5)->get();

        Circle::whereIn('id',auth()->user()->circles->pluck('id')->toArray())->get();

        return view('circles.index',compact('circles'));
    }

    public function create(){
        return view('circles.create');
    }

    public function store(){
        $this->validate(request(),[
            'name' => 'required|string|max:50',
            'public' => 'required|boolean'
        ])

        $circle = new Circle;
        $circle->owner_id = auth()->user()->id;
        $circle->name = request('name');
        $circle->public = request('public');
        
        $circle->save();

        auth()->user()->circles->attach($circle->id);

        return redirect("/view/circle/{$circle->id}");
    }

    public function show(Circle $circle){
        if ($circle->public)
        return view('circles.show',compact('circle'));

        if (in_array($circle->id , auth()->user()->circles->pluck('id')->toArray()))
        return view('circles.show',compact('circle'));

        return view('circles.index');
    }

    public function search(){
        if(!auth()->check())
        $circles = Circle::where('public',true)->paginate(10)->get();
        
        else {
            $circles = Circle::where('public',true)
                ->orWhere(function($query){
                            $query->whereIn('id',auth()->user()->circles->pluck('id')->toArray());
                        })->paginate(10)->get();
        }

        return view('circles.index',compact('circles'));
    }]

    public function update(Circle $circle){
        if(auth()-user()->id != $circle->owner_id)
        return redirect("/view/circle/{$circle->id}")
                    ->withErrors('edit' => 'You must be owner to edit this circle!');

        $this->validate(request(),[
            'name' => 'nullable|string|max:50',
            'public' => 'nullable|boolean',
            'user_id' => [
                'nullable',
                Rule::in(User::pluck('id')->toArray()),
                Rule::notIn($circle->users->pluck('id')->toArray())
            ]
        ]);

        if(request('name'))
        $circle->name=request('name');

        if(request('public'))
        $circle->public=request('public');
        
        if(request('user_id'))
        $circle->users()->attach(request('user_id'));

        $circle->save();


    }

    public function destroy(Circle $circle){
        if (auth()->user()->id != $circle->owner_id)
        return redirect("/view/circle/{$circle->id}")
                    ->withErrors(['delete' => 'You are not the owner of the circle!']);

        $circle->users()->detach();
        $circle->delete();

        return view('circles.index');
    }

}
