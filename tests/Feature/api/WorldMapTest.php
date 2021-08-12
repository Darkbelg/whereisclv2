<?php

namespace Tests\Feature\api;

use App\Models\Event;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class WorldMapTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_get_lat_long_for_all_events()
    {
        $events = Event::factory(3)->create();
        $this->withoutExceptionHandling();
        $response = $this->getJson('/api/world-map-events');

        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'title',
                    'latitude',
                    'longitude'
                ]
            ]
        ]);
        $response->assertStatus(200);
    }
}
