<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = ['event_id', 'ticket_type', 'price'];

    public function event()
    {
        return $this->belongsTo(Event::class);  // Inverse of the one-to-many relationship with events
    }
}
