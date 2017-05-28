<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Circle;
use App\Models\User;

class CircleController extends Controller
{
    public function index(){
        $circles = auth()->user()->circles;
        $sidebar_items = $this->getSidebarMenuItems();

        return view('views.circles', compact('circles', 'sidebar_items'));
    }

    public function create(){
        return view('views.circle.create');
    }

    public function store(){
        
        if(!request('name') || strlen(request('name')) > 50)
            redirect()->back();

        $name = trim(request('name'));

        $circle = new Circle;
        $circle->user_id = auth()->user()->id;
        $circle->name = $name;

        $circle->save();

        auth()->user()->circles()->attach($circle->id);

        return redirect("/view/circle/{$circle->id}");
    }

    public function show($id){
        $circle = Circle::find($id);

        if ($circle && ($circle->public || in_array($circle->id , auth()->user()->circles->pluck('id')->toArray()))){
            $sidebar_items = $this->getSidebarMenuItems();
            
            $users = $circle->users->where('id','<>',auth()->user()->id)->sort(function($u1, $u2){
                        if(strcmp($u1->first_name, $u2->first_name) != 0)
                            return strcmp($u1->first_name, $u2->first_name);
                        else return strcmp($u1->last_name, $u2->last_name);
                    })->all();
            return view('views.circle_show',compact('circle','sidebar_items','users'));
        }

        return redirect('/view/circles');
    }

    public function search(){
        $sidebar_items = $this->getSidebarMenuItems();

        if(!auth()->check())
            $circles = Circle::where('public',true)->paginate(10);

        else {
            $circles = Circle::where('public',true)
                ->orWhere(function($query){
                    $query->whereIn('id',auth()->user()->circles->pluck('id')->toArray());
                })->paginate(10);
        }

        return view('views.circles',compact('circles','sidebar_items'));
    }

    public function update($id){
        $circle=Circle::find($id);
        if($circle == null)
            return redirect('/view/circles');

        if(request('public')){
            $circle->public = !$circle->public;
            $circle->save();
            return redirect("view/circle/{$circle->id}");
        }
        if(request('leave_circle')){
            $circle->users()->detach(request('leave_circle'));
            $circle->save();
            return redirect("view/circle/{$circle->id}");
        }
 
        if(auth()->user()->id != $circle->user_id)
            return redirect("/view/circle/{$circle->id}")
            ->withErrors(['edit' => 'Nu sunteti administratorul cercului!']);

        $message=array();
        if(request('name')){
            if (strlen($request('name')) <= 255)
                $circle->name = request('name');
            else
                $message['circle_name'] = 'Nume prea lung!';
        }

        if(request('public'))
            $circle->public = !$circle->public;

        if(request('user_id')){
            if(in_array(request('user_id'),$circle->users->pluck('id')->toArray()))
                $circle->users()->detach(request('user_id'));
            else
                $message['delete_user'] = 'Utilizatorul introdus nu este membru!';
        }

        if(request('username')){
            if(strlen(request('username'))<=512){
                $input = trim(request('username'));
                $names = preg_split("~ ~",$input,NULL,PREG_SPLIT_NO_EMPTY);
                if (count($names) == 1 && strpos($input,'@'))
                    $user = User::where('email',$input)->first();
                else if (count($names) == 2){
                    $user = User::where(function ($query) use ($names){
                                $query->where('first_name',$names[0])->where('last_name',$names[1]);
                                })->orWhere(function ($query) use ($names){
                                    $query->where('first_name',$names[1])->where('last_name',$names[0]); 
                                })->first();
                }
                else $user = null;
                if ($user == null)
                    $message['add_user'] = 'Identificator invalid!';
                
                else if(in_array($user->id,$circle->users->pluck('id')->toArray()))
                    $message['add_user'] = 'Utilizatorul introdus este deja membru!';
                else
                    $circle->users()->attach($user->id);
            }
            else
                $message['add_user'] = 'Identificator invalid!';
        }

        $circle->save();

        return redirect("/view/circle/{$circle->id}")->withErrors($message);
    }

    public function destroy($id){
        $circle = Circle::find($id);
        if($circle == null)
            return redirect('/view/circles');
        if (auth()->user()->id != $circle->user_id)
            return redirect("/view/circle/{$circle->id}")
            ->withErrors(['delete_circle' => 'Nu sunteti administratorul cercului!']);

        $circle->users()->detach();
        $circle->delete();

        return redirect('/view/circles');
    }

}
