<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\User;
use App\Models\Video;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i < 24; $i++) { 
            Event::factory()->hasVideos(rand(1,10))->create();
        }
        //Video::factory(50)->create();
        User::factory()->create([
            'name' => "JohnDoe",
            'email' => "JohnDoe@example.com",
            'email_verified_at' => now(),
        ]);
        // \App\Models\User::factory(10)->create();
    }
}
