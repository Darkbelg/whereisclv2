<?php

namespace Tests\Feature;

use App\Models\Tag;
use App\Models\Video;
use App\Service\YoutubeApi;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RefreshTest extends TestCase
{
    use RefreshDatabase;

    public function test_guests_may_not_refresh()
    {
        $this->get('/refresh')
            ->assertRedirect('/login');
    }

    public function test_an_authenticated_user_can_refresh_all_video_data()
    {
        $this->signIn();

        $videoDatabaseFirst = Video::factory()->create(['id' => "JeGhUESd_1o_1", "views" => "100"]);
        $videoDatabaseSecond = Video::factory()->create(['id' => "JeGhUESd_1o_2", "views" => "100"]);
        $videoDatabaseThird = Video::factory()->create(['id' => "JeGhUESd_1o_3", "views" => "100"]);


        $mock = $this->partialMock(YoutubeApi::class, function ($mock) {
            $mock->shouldReceive('getVideoMetaData')->andReturn(
                $this->getVideoMetaDataById("JeGhUESd_1o_1"),
                $this->getVideoMetaDataById("JeGhUESd_1o_2"),
                $this->getVideoMetaDataById("JeGhUESd_1o_3")
            );
        });

        $this->withoutExceptionHandling()->get("/refresh")->assertRedirect('/');

        $this->assertEquals('45', count($videoDatabaseFirst->fresh()->tags));
        $this->assertEquals('3741389', $videoDatabaseFirst->fresh()->views);

        $this->assertEquals('45', count($videoDatabaseSecond->fresh()->tags));
        $this->assertEquals('200000', $videoDatabaseSecond->fresh()->views);

        $this->assertEquals('45', count($videoDatabaseThird->fresh()->tags));
        $this->assertEquals('3000000', $videoDatabaseThird->fresh()->views);
    }
}
