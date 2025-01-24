<?php

namespace Database\Seeders;

use App\Models\Attendee;
use Illuminate\Database\Seeder;

class AttendeeSeeder extends Seeder
{
    public function run()
    {
        Attendee::factory(50)->create();
    }
}



