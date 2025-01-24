<?php

namespace Database\Factories;

use App\Models\Ticket;
use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;

class TicketFactory extends Factory
{
    protected $model = Ticket::class;

    public function definition()
    {
        return [
            'event_id' => Event::factory(),  // Generates a related event automatically
            'ticket_type' => $this->faker->randomElement(['General Admission', 'VIP', 'Standard', 'Premium']),
            'price' => $this->faker->randomFloat(2, 20, 200),
        ];
    }
}

