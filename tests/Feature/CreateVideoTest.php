<?php

namespace Tests\Feature;

use App\Http\Controllers\VideoController;
use App\Models\Channel;
use App\Models\Event;
use App\Models\Video;
use App\Service\YoutubeApi;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery\MockInterface;
use Tests\TestCase;

class CreateVideoTest extends TestCase
{

    use RefreshDatabase;

    public function test_a_guest_may_not_get_meta_information_video()
    {
        $this->get('video/id/JeGhUESd_1o')
            ->assertRedirect('/login');
    }

    public function test_an_authenticated_user_can_get_meta_information_video()
    {
        $this->signIn();

        $this->withoutExceptionHandling();
        $response = $this->get('video/id/JeGhUESd_1o');

        $response->assertSee('CL +5 STAR+ Official Video');
    }

    public function test_every_video_has_a_channel()
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

        $this->partialMock(YoutubeApi::class, function (MockInterface $mock) {
            $mock->shouldReceive('getVideoMetaData')->once()->andReturn($this->getVideoMetaDataById());
        });

        $response = $this->withoutExceptionHandling()
            ->post('/videos', ["youtube" => [$videoId], "event" => $event->id]);

        $this->assertDatabaseCount('tags', 45)
            ->assertDatabaseCount('channels', 1)
            ->assertDatabaseCount('thumbnails', 5)
            ->get($response->headers->get('Location'))
            ->assertSee("Mock CL +5 STAR+ Official Video");
    }

    public function test_an_user_can_add_multiple_videos_to_one_event()
    {
        $this->signIn();

        $event = Event::factory()->create();

        $videoIdFirst = "JeGhUESd_1o_1";
        $videoIdSecond = "JeGhUESd_1o_2";
        $videoIdThird = "JeGhUESd_1o_3";

        $this->partialMock(YoutubeApi::class, function ($mock) {
            $mock->shouldReceive('getVideoMetaData')->andReturn(
                $this->getVideoMetaDataById("JeGhUESd_1o_1"),
                $this->getVideoMetaDataById("JeGhUESd_1o_2"),
                $this->getVideoMetaDataById("JeGhUESd_1o_3")
            );
        });

        $response = $this->withoutExceptionHandling()->post('/videos', ["youtube" => [$videoIdFirst,$videoIdSecond,$videoIdThird,null,null,null,null,null,null,null], "event" => $event->id]);

        $this->assertEquals('3', Video::All()->count());
    }

    public function test_guest_may_not_delete_a_video()
    {
        $this->delete('/videos/2')
            ->assertRedirect('/login');
    }

    public function test_an_authenticated_user_deletes_a_video()
    {
        $this->signIn();

        $video = Video::factory()->hasEvents()->create();

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
