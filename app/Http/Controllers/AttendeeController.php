<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Attendee;
use Illuminate\Http\Request;

class AttendeeController extends Controller
{
    // Register user as attendee for an event
    public function store(Request $request, Event $event)
    {
        $attendee = new Attendee();
        $attendee->user_id = auth()->id();
        $attendee->event_id = $event->id;
        $attendee->save();

        return response()->json($attendee, 201);
    }

    // Remove user as attendee for an event
    public function destroy(Request $request, Event $event)
    {
        $attendee = Attendee::where('user_id', auth()->id())
                            ->where('event_id', $event->id)
                            ->first();

        if ($attendee) {
            $attendee->delete();
            return response()->json(null, 204);
        }

        return response()->json(['message' => 'Attendee not found'], 404);
    }
}
