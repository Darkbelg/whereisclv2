<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateVideoTest extends TestCase
{
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

        $response->assertSee('JeGhUESd_1o');
    }
}
