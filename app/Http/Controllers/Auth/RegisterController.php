<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
     */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = 'view/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'image' => 'max:8000|dimensions:min_width=20,min_height=20,max_width=4000,max_height=4000|mimes:jpeg,jpg,png',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $file = Input::file('image');
        $new_user = User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'image' => null,
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'admin' => false,
        ]);

        $extension = $file->getMimeType();
        $extension = explode("/", $extension)[1];
        $new_image_name = ((string) $new_user->id) . "." . $extension;
        $file = $file->move(public_path() . '/images/profile_images/' , $new_image_name);
        $image_path = $file->getRealPath();
        $new_user->image = $image_path;
        $new_user->save();
        return $new_user;
    }
}
