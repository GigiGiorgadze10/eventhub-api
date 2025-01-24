<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            EventSeeder::class,
            TicketSeeder::class,
            ReviewSeeder::class,
            AttendeeSeeder::class,  
        ]);
    }
}

