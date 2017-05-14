<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Image;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\User;

class ImageController extends Controller
{
    /**
     * Return sidebar icon
     *
     * @return Response
     */
    public function sidebarIcon($img)
    {
        $image_path = resource_path('assets/images/sidebar_icons/' . $img);

        return Image::make($image_path)->resize(20, 20)->response('png');
    }

    /**
     * Return the dafault user profile photo
     *
     * @return Response
     */
    public function defaultUser()
    {
        $image_path = resource_path('assets/images/default_user.png');

        return Image::make($image_path)->resize(70, 70)->response('png');
    }

    /**
     * Return the image associated with user.
     *
     * @throws ModelNotFoundException
     * @return Response
     */
    public function userImage($id)
    {
        if (Auth::id() != $id)
            throw new ModelNotFoundException;

        $user = User::findOrFail($id);

        $image_path = $user->image;
        return Image::make($image_path)->resize(70, 70)->response('png');
    }
}
