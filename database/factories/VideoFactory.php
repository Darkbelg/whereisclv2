<?php

namespace Database\Factories;

use App\Models\Channel;
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
        $title = $this->faker->sentence;
        $id = $this->faker->regexify('[A-Z0-9._+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}');
        
        $sizes = ["default","high","maxres","medium","standard"];
        foreach ($sizes as $size) {
            Thumbnail::factory()->create(['video_id' => $id,'size' => $size]);
        }

        return [
            'id' => $id,
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'channel_id' => function (){
                return Channel::factory()->create()->id;
                //return factory('App\Channel')->create()->id;
            },
            'published_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'comments' =>  $this->faker->randomNumber(),
            'dislikes' => $this->faker->randomNumber(),
            'likes' => $this->faker->randomNumber(),
            'views' => $this->faker->randomNumber(),
        ];
    }
}
