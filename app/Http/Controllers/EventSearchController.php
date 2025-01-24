<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventSearchController extends Controller
{
    public function __invoke(Request $request)
    {
        $query = Event::query();

        if ($request->has('name')) {
            $query->where('name', 'like', '%' . $request->get('name') . '%');
        }

        if ($request->has('location')) {
            $query->where('location', 'like', '%' . $request->get('location') . '%');
        }

        if ($request->has('start_date') && $request->has('end_date')) {
            $query->whereBetween('date', [
                $request->get('start_date'),
                $request->get('end_date'),
            ]);
        }

        $events = $query->get();

        return response()->json($events);
    }
}
