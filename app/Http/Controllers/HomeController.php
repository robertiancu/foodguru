<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * @var App\AppMisc\AppVisualItems
     */
    protected $admin_misc;

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sidebar_items = $this->getSidebarMenuItems();

        return view('views.home', compact('sidebar_items'));
    }
}
