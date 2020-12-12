<?php

namespace Database\Factories;

use App\Models\Channel;
use App\Models\Event;
use App\Models\Tag;
use App\Models\Thumbnail;
use App\Models\Video;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class VideoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Video::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
       
        $id = $this->faker->regexify('[A-Z0-9._+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}');
        $event = Event::factory()->create();
        $channel = Channel::factory()->create();
        $video = $channel->videos()->create([
            'id' => $id,
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'published_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'comments' =>  $this->faker->randomNumber(),
            'dislikes' => $this->faker->randomNumber(),
            'likes' => $this->faker->randomNumber(),
            'views' => $this->faker->randomNumber(),
        ]);

        $event->videos()->attach($video->id);

        $sizes = ["default","high","maxres","medium","standard"];
        foreach ($sizes as $size) {
            Thumbnail::factory()->create(['video_id' => $id,'size' => $size]);
        }

        for ($i=0; $i < 45; $i++) { 
            $video->tags()->create([
                "tag" => $this->faker->word()
            ]);
        }

        return $video->toArray();
    }
}
