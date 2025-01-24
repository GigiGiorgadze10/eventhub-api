<?php

namespace Database\Factories;

use App\Models\Attendee;
use App\Models\User;
use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;

class AttendeeFactory extends Factory
{
    protected $model = Attendee::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(),  
            'event_id' => Event::factory(),  
        ];
    }
}

