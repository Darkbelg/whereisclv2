<?php

namespace Tests\Feature;

use App\Models\Video;
use GuzzleHttp\Promise\Create;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateVideoTest extends TestCase
{

    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function testGetMetaInformationVideo(){

        $this->withoutExceptionHandling();
        $response = $this->get('video/id/JeGhUESd_1o');

        $response->assertSee('CL +5 STAR+ Official Video');
    }

    public function testEveryVideoHasAChannel()
    {
        $video = Video::factory()->create();

        $channelId = $video->toArray()["channel_id"];
        
        $this->assertEquals(0,$channelId);

        
    }
}
