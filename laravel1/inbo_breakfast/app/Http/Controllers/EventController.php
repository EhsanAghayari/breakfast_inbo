<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;


class EventController extends Controller
{
    // Loads Events List in Add Event Route
    public static function showEvent()
    {
        $events = \App\Models\Event::all()->sortBy('created_at');
        $users = \App\Models\User::all();
        $usernames = [];

        return view('add-event', ['events' => $events, 'users' => $users, 'usernames' => $usernames]);
    }

    // Adds a New Event
    public static function addTheEvent(Request $request)
    {
        $request->validate([
            'description' => 'required|min:2|max:300',
            'userId' => 'required|array',
            'userId.*' => 'exists:users,id',
        ]);

        $event = new \App\Models\Event();
        $event->description = $request->description;
        if($request->datePicker != null) {
            $event->created_at = $request->datePicker;
        }else{
            $event->created_at = time();
        }

        $event->save();
        $event->users()->sync($request->userId);

        return redirect('addEvent');

    }

    // Go to Edit Event Page
    public static function editEvent(Request $request, $id)
    {
        $users = \App\Models\User::all();
        $event = \App\Models\Event::where('id', $id)->first();
        return view('edit-event', ['event' => $event, 'users' => $users]);
    }

    public static function updateEvent(Request $request)
    {
//        $request->validate([
//            'description' => 'required|min:2|max:300',
//            'userId' => 'required',
//            'userId.*' => 'exists:users,id'
//        ]);
//
//        // Needs To be Changed
//
//        $test = User::events()->get();
//        dd($test);
//
//        $event = \App\Models\Event::where('id', $request->current)->first();
//        $event->description = $request->description;
//
//        $event->save();
//        $event->users()->sync($request->userId);
//
////        return redirect('addEvent');
//        return back();
        $request->validate([
            'description' => 'sometimes|min:2|max:300',
            'userId' => 'required|array',
            'userId.*' => 'exists:users,id',
        ]);

        $event = \App\Models\Event::where('id', $request->current)->first();
        if($request->has('description')) {
            $event->description = $request->description;
        }
        if($request->datePicker != null) {
            $event->created_at = $request->datePicker;
        }else{
            $event->created_at = time();
        }

        $event->save();
        $event->users()->sync($request->userId);

        return redirect('addEvent');
    }

    public static function deleteEvent(Request $request, $id)
    {
        $event = \App\Models\Event::where('id', $id);
        $event->delete();
        return redirect('addEvent');
    }
}
