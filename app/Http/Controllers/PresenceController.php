<?php

namespace App\Http\Controllers;

use App\Models\Presence;
use Illuminate\Http\Request;

class PresenceController extends Controller
{
    public function index()
    {
        $today = date('Y-m-d', time());

        $presence = Presence::where(
            ['user_id' => auth()->user()->id, 'date' => $today]
        )->first();

        // dd($presence);

        // dd(auth()->user()->image_url);

        return view('presence.index', ['presence' => $presence, 'today' => $today]);
    }

    public function presence()
    {
        $timestamp = time();
        $today = date('Y-m-d', $timestamp);
        $time = (string)date('H:i:s', $timestamp);
        $userId = auth()->user()->id;

        // dd($hour);

        $presence = Presence::where(
            ['user_id' => $userId, 'date' => $today]
        )->first();

        // dd($presence);

        $hour = (int)date('H', time());

        if ($presence) {
            if ($hour <= 12) {
                $presence->arrive_time = $time;
            } else {
                $presence->return_time = $time;
            }
            $presence->save();
        } else {
            $newPresence = new Presence;
            if ($hour <= 12) {
                $newPresence->arrive_time = $time;
            } else {
                $newPresence->return_time = $time;
            }
            $newPresence->date = $today;
            $newPresence->user_id = $userId;
            $newPresence->save();
        }

        return redirect('/');
    }
}
