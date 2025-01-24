<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateEventRequest; 
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        return response()->json(Event::all());
    }

    public function show($id)
    {
        return response()->json(Event::findOrFail($id));
    }

    public function store(CreateEventRequest $request)
    {
        $event = Event::create($request->validated());

        return response()->json($event, 201);
    }
}
