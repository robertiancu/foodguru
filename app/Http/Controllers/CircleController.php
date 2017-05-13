<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Circle;
use App\Models\User;

class CircleController extends Controller
{
    public function index(){
        $circles = auth()->user()->circles;

        return view('circles.index',compact('circles'));
    }

    public function create(){
        return view('circles.create');
    }

    public function store(){
        $this->validate(request(),[
            'name' => 'required|string|max:50',
            'public' => 'required|boolean'
        ]);

        $circle = new Circle;
        $circle->user_id = auth()->user()->id;
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
            $circles = Circle::where('public',true)->paginate(10);

        else {
            $circles = Circle::where('public',true)
                ->orWhere(function($query){
                    $query->whereIn('id',auth()->user()->circles->pluck('id')->toArray());
                })->paginate(10);
        }

        return view('circles.index',compact('circles'));
    }

    public function update(Circle $circle){
        if(auth()-user()->id != $circle->user_id)
            return redirect("/view/circle/{$circle->id}")
            ->withErrors(['edit' => 'Nu sunteti administratorul cercului!']);

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

        return redirect("/view/circle/{$circle->id}");
    }

    public function destroy(Circle $circle){
        if (auth()->user()->id != $circle->user_id)
            return redirect("/view/circle/{$circle->id}")
            ->withErrors(['delete' => 'Nu sunteti administratorul cercului!']);

        $circle->users()->detach();
        $circle->delete();

        return view('circles.index');
    }

}
