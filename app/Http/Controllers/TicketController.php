<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Event;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function store(Request $request, Event $event)
    {
        $ticket = $event->tickets()->create([
            'user_id' => auth()->id(),
            'quantity' => $request->quantity,
        ]);

        return response()->json($ticket, 201);
    }
    
    public function index(Event $event)
    {
        return $event->tickets;
    }
}
