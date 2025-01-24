<?php

namespace Tests\Feature;

use App\Models\Event;
use App\Models\Review;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ReviewControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_add_review_to_event()
    {
        $event = Event::factory()->create();

        $data = [
            'rating' => 5,
            'comment' => 'Amazing event!',
        ];

        $response = $this->postJson("/api/events/{$event->id}/reviews", $data);

        $response->assertStatus(201)
            ->assertJson(['rating' => $data['rating']]);

        $this->assertDatabaseHas('reviews', ['event_id' => $event->id, 'comment' => $data['comment']]);
    }
}
