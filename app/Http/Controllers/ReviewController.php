<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Event;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    // Create a review for an event
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

    // View all reviews for an event
    public function index(Event $event)
    {
        return $event->reviews;
    }
}
