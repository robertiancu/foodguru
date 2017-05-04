<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AppMisc\AppVisualItems;
use App\Transformers\UrlTransformer;

class HomeController extends Controller
{
    /**
     * @var App\AppMisc\AppVisualItems
     */
    protected $admin_misc;

    /**
     * Create a new controller instance.
     *
     * @param App\AppMisc\AppVisualItems
     * @param App\Transformers\UrlTransformer
     *
     * @return void
     */
    public function __construct(AppVisualItems $app_visual_items, UrlTransformer $url_transformer)
    {
        $this->app_visual_items = $app_visual_items;
        $this->url_transformer = $url_transformer;
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sidebar_items = $this->app_visual_items->getSidebarMenuItems();

        $url = url('/');
        $sidebar_items = $this->url_transformer->transformArray($sidebar_items, compact('url'));

        return view('views.home', compact('sidebar_items'));
    }
}
