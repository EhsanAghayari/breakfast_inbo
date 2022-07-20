<?php

namespace App\Http\Controllers;

use App\Models;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RateController extends Controller
{
    //
//    public static function setRate($rate, $criticism, $event_id, Request $request)
//    {
////        $request->validate([
////            'rate' => 'required|double',
////            'criticism' => 'required|max:300',
////        ]);
//
//        $newRate = new Models\Rate;
//        $newRate->rate = $rate;
//        $newRate->criticism = $criticism;
//        $newRate->user_id = Auth::user()->id;
//        $newRate->event_id = $event_id;
//        $newRate->save();
//    }

    public static function showComments($event_id, Request $request)
    {
        $chosenEvent = Models\Event::where('id', $event_id)->first();
        $ratesOfEvent = Models\Rate::all()->where('event_id', $event_id)->sortByDesc('rate');
        $usernames = [];

        return view('rates', ['chosenEvent' => $chosenEvent, 'ratesOfEvent' => $ratesOfEvent, 'usernames' => $usernames]);
    }

    public static function addTheRate(Request $request)
    {

        $request->validate([
            'rate' => 'required',
            'criticism' => 'required|min:1|max:200',
        ]);

        $rate = new \App\Models\Rate();
        $exists = Models\Rate::where('user_id', Auth::user()->id)->where('event_id', $request->eventId)->first();
        if ($exists != null) {
            return back()->with('fail', 'You have already commented');
        } else {

            $rate->rate = $request->input('rate');
            $rate->criticism = $request->criticism;
            $rate->user_id = Auth::user()->id;
            $rate->event_id = $request->eventId;
            $rate->save();

            return back();
        }
    }
}
