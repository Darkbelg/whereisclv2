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

    public function test_an_user_can_create_new_event()
    {
        $this->signIn();
        
        //person has to be logged in to create a event
        //We make a post call to a certain endpoint
        $event = Event::factory()->make();
        $this->withoutExceptionHandling();

        $response = $this->post('/events',$event->toArray());

        $this->get($response->headers->get('Location'))
        ->assertSee($event->title)
        ->assertSee($event->location);
    }

    public function test_an_guest_can_not_update_a_event(){
        $event = Event::factory()->create();

        $this->patch("/events/{$event->id}")
            ->assertRedirect('login');
    }

    public function test_a_empty_patch_does_not_update()
    {
        $event = Event::factory()->create();

        $response = $this->signIn()
        ->patch("/events/{$event->id}")
        ->assertSessionHasErrors(('title'));
    }

    public function test_an_user_can_update_a_event(){

        $this->signIn()->withoutExceptionHandling();

        $originalEvent = Event::factory()->create();

        $updatedEvent = Event::factory()->make(['id' => $originalEvent->id]);

        $this->patch("/events/{$originalEvent->id}",$updatedEvent->toArray())->assertRedirect('/events/' . $originalEvent->id);

        $this->assertDatabaseHas('events', 
        [
            "id" =>  $originalEvent->id,
            "title" => $updatedEvent->title,
            "location" => $updatedEvent->location
        ]);
        
    }
    
    public function test_an_guest_can_not_delete_a_event(){
        /*
        $reply = create('App\Reply');

        $this->patch("/replies/{$reply->id}")
            ->assertRedirect('login');

        // $this->withoutExceptionHandling();
        $this->signIn()
            ->patch("/replies/{$reply->id}")
            ->assertStatus(403);*/
    }

    public function test_an_user_can_delete_a_event()
    {
        $this->signIn();

        $event = Event::factory()->create();

        $this->delete("/events/{$event->id}");

        $this->assertEquals(0, Event::count());
    }

}
