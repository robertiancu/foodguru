<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FridgeController extends Controller
{
    //
    /**
     * Return the fridge view
     *
     * @return Response
     */
    public function index()
    {
        $sidebar_items = $this->getSidebarMenuItems();
        return view('views.fridge', compact('sidebar_items'));
    }
}
