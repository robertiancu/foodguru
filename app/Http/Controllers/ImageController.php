<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Image;

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

        return Image::make($image_path)->resize(30, 30)->response('png');
    }

    /**
     * Return the dafault user profile photo
     *
     * @return void
     */
    public function defaultUser()
    {
        $image_path = resource_path('assets/images/default_user.png');

        return Image::make($image_path)->resize(60, 60)->response('png');
    }
}
