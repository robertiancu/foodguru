<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class EventController extends Controller
{
    /**
     * Store the event form request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        return null;
    }

    /**
     * Return the view with events for this user
     *
     * @return Response
     */
    public function index()
    {
        // TODO
    }

    /**
     * Return the requested event if this user has access to it.
     *
     * @return Response
     */
    public function show($id)
    {
        $event = Event::findOrFail($id);

        //$user = Auth::user();
        $user = User::findOrFail(20);

        // TODO Restrict access to this event

        $sidebar_items = $this->getSidebarMenuItems();

        //$owner = $event->user_id == $user->id;
        $owner = true;

        return view('views.event', 
            compact('sidebar_items', 'event', 'owner'));
    }

    /**
     * Get all users in json for event id.
     *
     * @return Response
     */
    public function getUsersForEvent($id)
    {
        $event = Event::findOrFail($id);

        $users = $event->users;

        return $users;
    }

    /**
     * Remove user from event.
     *
     * @return Response
     */
    public function removeUserFromEvent(Request $request)
    {
        $event_id = $request->input('event_id');
        $event = Event::findOrFail($event_id);

        $user_id = $request->input('user_id');
        $user = User::findOrFail($user_id);

        //if ($event->users->contain($user)) {
            //return $event->delete();
        //} else
            //throw new \Exception("Don't have rights to delete this event");
        return $user->events()->detach($event->id);
    }
}
