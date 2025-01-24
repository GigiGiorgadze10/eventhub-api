<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendee extends Model
{
    use HasFactory;

    // The attributes that are mass assignable
    protected $fillable = ['user_id', 'event_id'];

    // Relationship with the Event model
    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    // Relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

