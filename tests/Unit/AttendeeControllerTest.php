<?php

namespace Tests\Feature;

use App\Models\Attendee;
use App\Models\Event;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AttendeeControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_register_attendee_to_event()
    {
        $event = Event::factory()->create();

        $data = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
        ];

        $response = $this->postJson("/api/events/{$event->id}/attendees", $data);

        $response->assertStatus(201)
            ->assertJson(['name' => $data['name']]);

        $this->assertDatabaseHas('attendees', ['email' => $data['email']]);
    }
}
