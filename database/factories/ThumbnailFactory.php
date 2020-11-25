<?php

namespace Database\Factories;

use App\Models\Thumbnail;
use Illuminate\Database\Eloquent\Factories\Factory;

class ThumbnailFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Thumbnail::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $width = $this->faker->numberBetween(120,1280);
        $height = $this->faker->numberBetween(90,720);

        return [
            'video_id' => $this->faker->regexify('[A-Z0-9._+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}'),
            'size' => "default",
            'url' => $this->faker->imageUrl($width,$height),
            'width' => $width,
            'height' => $height
        ];
    }
}
