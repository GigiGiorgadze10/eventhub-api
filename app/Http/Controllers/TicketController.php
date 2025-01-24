<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Event;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    // Book a ticket for an event
    public function store(Request $request, Event $event)
    {
        // Logic to create a ticket
        $ticket = $event->tickets()->create([
            'user_id' => auth()->id(),
            'quantity' => $request->quantity,
        ]);

        return response()->json($ticket, 201);
    }

    // View all tickets for an event
    public function index(Event $event)
    {
        return $event->tickets;
    }
}
