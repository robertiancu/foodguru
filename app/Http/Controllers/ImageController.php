<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageController extends Controller
{
    /**
     * Return the default user photo
     *
     * @return Response
     */
    public function baseImage($img)
    {
        $image_path = resource_path('assets/images/' . $img);

        return \Image::make($image_path)->resize(30, 30)->response('png');
    }
}
