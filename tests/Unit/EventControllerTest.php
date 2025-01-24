<?php

namespace Tests\Feature;

use App\Models\Event;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EventControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_all_events()
    {
        Event::factory()->count(5)->create();

        $response = $this->getJson('/api/events');

        $response->assertStatus(200)
            ->assertJsonCount(5)
            ->assertJsonStructure([
                '*' => ['id', 'name', 'date', 'location', 'description', 'created_at', 'updated_at']
            ]);
    }

    public function test_can_show_single_event()
    {
        $event = Event::factory()->create();

        $response = $this->getJson('/api/events/' . $event->id);

        $response->assertStatus(200)
            ->assertJson([
                'id' => $event->id,
                'name' => $event->name,
                'location' => $event->location,
            ]);
    }

    public function test_can_create_event()
    {
        $data = [
            'name' => 'Sample Event',
            'date' => '2025-01-01',
            'location' => 'Venue X',
            'description' => 'This is a test event.',
            'ticket_price' => 100.00,
        ];

        $response = $this->postJson('/api/events', $data);

        $response->assertStatus(201)
            ->assertJson(['name' => $data['name']]);

        $this->assertDatabaseHas('events', $data);
    }
}
