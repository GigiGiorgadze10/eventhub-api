<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateEventRequest; // Import the validation request class
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    // List all events
    public function index()
    {
        // Return all events in JSON format
        return response()->json(Event::all());
    }

    // Show single event details
    public function show($id)
    {
        // Find and return the event by ID, or fail with 404 error if not found
        return response()->json(Event::findOrFail($id));
    }

    // Store a new event (with validation)
    public function store(CreateEventRequest $request)
    {
        // Create a new event using validated data from the CreateEventRequest
        $event = Event::create($request->validated());

        // Return the created event as a JSON response with status code 201 (created)
        return response()->json($event, 201);
    }
}
