<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\AttendeeController;
use App\Http\Controllers\EventSearchController;

// Public Routes
Route::get('/test', function () {
    return response()->json(['message' => 'EventHub API is working!']);
});

// Event Search
Route::get('/events/search', EventSearchController::class);

// Authentication Routes
Route::post('/register', [RegisteredUserController::class, 'store']);
Route::post('/login', [AuthenticatedSessionController::class, 'store']);
Route::post('/forgot-password', [PasswordResetLinkController::class, 'store']);

// Public Event Routes
Route::prefix('events')->group(function () {
    Route::get('/', [EventController::class, 'index']); // List all events
    Route::get('/{event}', [EventController::class, 'show']); // Show single event details
});

// Authenticated Routes
Route::middleware('auth:sanctum')->group(function () {

    // Get Authenticated User
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // Attendee Routes
    Route::prefix('events/{event}')->group(function () {
        Route::post('/attend', [AttendeeController::class, 'store']); // Register as attendee
        Route::delete('/attend', [AttendeeController::class, 'destroy']); // Remove attendee

        // Ticket Routes
        Route::post('/tickets', [TicketController::class, 'store']); // Book a ticket
        Route::get('/tickets', [TicketController::class, 'index']); // View tickets for an event

        // Review Routes
        Route::post('/reviews', [ReviewController::class, 'store']); // Create a review
        Route::get('/reviews', [ReviewController::class, 'index']); // View all reviews for an event
    });
});
