<?php

namespace Database\Seeders;

use App\Models\Attendee;
use Illuminate\Database\Seeder;

class AttendeeSeeder extends Seeder
{
    public function run()
    {
        // Create 50 attendees, each with a random user and event
        Attendee::factory(50)->create();
    }
}



