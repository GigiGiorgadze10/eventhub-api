<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Event;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request, Event $event)
    {
        $review = new Review();
        $review->user_id = auth()->id();
        $review->event_id = $event->id;
        $review->rating = $request->rating;
        $review->comment = $request->comment;
        $review->save();

        return response()->json($review, 201);
    }

    public function index(Event $event)
    {
        return $event->reviews;
    }
}
