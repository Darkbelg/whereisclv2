<?php

namespace Database\Factories;

use App\Models\Video;
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

        return [
            'title' =>,
            'description' =>,
            'tags' =>$this->faker->id,
            'thumbnails' =>$this->faker->id,
            'channelId' => $this->faker->id,
            'channelTitle' =>,
            'commentCount' =>,
            'dislikeCount' =>,
            'likeCount' =>,
            'viewCount' =>,
        ];
    }
}
