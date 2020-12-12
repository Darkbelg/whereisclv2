<?php

namespace Tests\Feature;

use App\Models\Channel;
use App\Models\Event;
use App\Models\Video;
use Google\Service;
use GuzzleHttp\Promise\Create;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Http;
use Mockery;
use Tests\TestCase;

class CreateVideoTest extends TestCase
{

    use RefreshDatabase;

    public function testGetMetaInformationVideo()
    {
        $this->signIn();

        $this->withoutExceptionHandling();
        $response = $this->get('video/id/JeGhUESd_1o');

        $response->assertSee('CL +5 STAR+ Official Video');
    }

    public function testEveryVideoHasAChannel()
    {
        $video = Video::factory()->create();

        $channelId = $video->toArray()["channel_id"];

        $channel = Channel::firstwhere('id', $channelId);

        $this->assertEquals($channelId, $channel->id);
    }

    public function test_guests_may_not_create_videos()
    {
        $this->get('/videos/create')
            ->assertRedirect('/login');

        $this->post('/videos')
            ->assertRedirect('/login');
    }

    public function test_an_user_can_create_new_video()
    {
        $this->signIn();

        $event = Event::factory()->create();

        $videoId = "JeGhUESd_1o";

        $response = $this->withoutExceptionHandling()
            ->post('/videos', ["youtube_id" => $videoId, "event" => $event->id]);

        $this->assertDatabaseCount('tags', 45)
            ->assertDatabaseCount('channels', 1)
            ->assertDatabaseCount('thumbnails', 5)
            ->get($response->headers->get('Location'))
            ->assertSee("CL +5 STAR+ Official Video");

        /*
        $this->get($response->headers->get('Location'))
        ->assertSee($video->title)
        ->assertSee($video->description);
        */
    }

    public function test_a_authenticated_user_deletes_a_video()
    {
        $this->signIn();
        $video = Video::factory()->create();

        //see if the right connections are made
        $this->assertDatabaseCount('tags', 45)
            ->assertDatabaseCount('events_videos', 1)
            ->assertDatabaseCount('tags_videos', 45)
            ->assertDatabaseCount('channels', 1)
            ->assertDatabaseCount('thumbnails', 5)
            ->assertDatabaseCount('events', 1);

        $response = $this->delete("/videos/" . $video->id);

        //see if the right connections are deleted
        $this->assertDatabaseCount('tags', 45)
            ->assertDatabaseCount('channels', 1)
            ->assertDatabaseCount('events_videos', 0)
            ->assertDatabaseCount('tags_videos', 0)
            ->assertDatabaseCount('thumbnails', 0)
            ->assertDatabaseCount('events', 1);
    }
}
