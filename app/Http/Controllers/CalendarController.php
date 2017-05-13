<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CalendarController extends Controller
{
    /**
     * Return the view with the calendar
     *
     * @return Response
     */
    public function index()
    {
        $sidebar_items = $this->getSidebarMenuItems();
        return view('views.calendar', compact('sidebar_items'));
    }
}
