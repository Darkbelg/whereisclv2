<?php

namespace Tests\Feature;

use App\Models\Event;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateEventTest extends TestCase
{

    use RefreshDatabase;
    

    public function test_guests_may_not_create_events(){
        $this->get('/events/create')
            ->assertRedirect('/login');

        $this->post('/events')
            ->assertRedirect('/login');
    }

    public function test_an_authenticated_user_can_create_new_event()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

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
