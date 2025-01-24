<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'event_date'];

    public function tickets()
    {
        return $this->hasMany(Ticket::class);  // One-to-many relationship with tickets
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);  // One-to-many relationship with reviews
    }

    public function attendees()
    {
        return $this->belongsToMany(User::class, 'attendees');  // Many-to-many relationship with users
    }
}
