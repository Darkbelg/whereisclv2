<?php

namespace Tests\Unit;

use App\Models\Tag;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;


class CreateTagTest extends TestCase
{

    use RefreshDatabase;

    /**
     * Test if a tag can be added to the database.
     *
     * @return void
     */
    public function test_tag_creation()
    {
        $tags = Tag::factory()->create(['id' => 1,'tag' => 'cl' ]);
        $tag = $tags->toArray(); 

        $this->assertEquals(1,$tag["id"]);
        $this->assertEquals("cl",$tag["tag"]);
    }
}
