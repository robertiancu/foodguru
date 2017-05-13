<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\AppMisc\AppVisualItems;
use App\Transformers\UrlTransformer;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * undocumented function
     *
     * @param App\AppMisc\AppVisualItems
     * @param App\Transformers\UrlTransformer
     *
     * @return array
     */
    public function getSidebarMenuItems()
    {
        $app_visual_items = new AppVisualItems();
        $sidebar_items = $app_visual_items->getSidebarMenuItems();

        $url = url('/');

        $url_transformer = new UrlTransformer();
        $sidebar_items = $url_transformer->transformArray($sidebar_items, compact('url'));

        return $sidebar_items;
    }
    
}
