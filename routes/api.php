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
use Illuminate\Support\Facades\Artisan;

Route::post('/send-test-email', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
    ]);

    $email = $request->input('email');

    Artisan::call('send:test-email', [
        'email' => $email,
    ]);

    return response()->json([
        'message' => "Test email sent to: {$email}",
    ]);
});


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
    Route::get('/', [EventController::class, 'index']); 
    Route::get('/{event}', [EventController::class, 'show']); 
});

// Authenticated Routes
Route::middleware('auth:sanctum')->group(function () {

    // Get Authenticated User
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // Attendee Routes
    Route::prefix('events/{event}')->group(function () {
        Route::post('/attend', [AttendeeController::class, 'store']); 
        Route::delete('/attend', [AttendeeController::class, 'destroy']); 

        // Ticket Routes
        Route::post('/tickets', [TicketController::class, 'store']); 
        Route::get('/tickets', [TicketController::class, 'index']); 

        // Review Routes
        Route::post('/reviews', [ReviewController::class, 'store']); 
        Route::get('/reviews', [ReviewController::class, 'index']); 
    });
});
