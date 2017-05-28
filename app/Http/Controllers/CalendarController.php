<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

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

        $events = $this->getEventsForThisUser();

        return view('views.calendar', compact('sidebar_items', 'events'));
    }

    /**
     * Return all the events that this user is incuded to
     * or posses.
     *
     * @return Collection
     */
    protected function getEventsForThisUser()
    {
        //$user = Auth::user();
        $user = User::findOrFail(20);

        $events = $user->events;

        $events_data = $events->map(function($event) use ($user) {
            return [
                'id' => $event->id,
                'name' => $event->name,
                'location' => $event->location,
                'day' => $event->day,
                'start_time' => $event->start_time,
                'end_time' => $event->end_time,
                'public' => $event->public,
                'owner' => $event->user_id == $user->id ? true : false,
                'users' => $event->users
            ];
        });


        return $events_data;
    }

    /**
     * Get json, special parsed for calendar
     *
     * @return Response
     */
    public function eventsForCalendar()
    {
        //$user = Auth::user();
        $user = User::findOrFail(20);

        $events = $user->events;

        $events = $events->map(function($event) {
            return [
                'title' => $event->name,
                'start' => $event->day . 'T' . $event->start_time,
                'end' => $event->day . 'T' . $event->end_time,
                'url' => url('/') . '/view/event/' . (string)$event->id
            ];
        });

        return $events;
    }
}
