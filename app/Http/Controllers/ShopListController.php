<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShopListController extends Controller
{
    /**
     * Return the shoping lists for this user's events
     *
     * @return Response
     */
    public function index()
    {
        $sidebar_items = $this->getSidebarMenuItems();
        return view('views.shop_list', compact('sidebar_items'));
    }
}
