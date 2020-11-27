<?php

namespace Tests\Feature;

use App\Models\Event;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateEventTest extends TestCase
{

    use RefreshDatabase;
    
    public function testCreateEvent()
    {
        //person has to be logged in to create a event
        //We make a post call to a certain endpoint
        $event = Event::factory()->make();
        $this->withoutExceptionHandling();

        $response = $this->post('/events',$event->toArray());

        $this->get($response->headers->get('Location'))
        ->assertSee($event->title)
        ->assertSee($event->location);
    }
}
