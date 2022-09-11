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
        return [
            'video_id' => $this->faker->regexify('[A-Z0-9._+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}'),
            'size' => "default",
            'url' => $this->faker->imageUrl(120, 90),
            'width' => 120,
            'height' => 90
        ];
    }

    /**
     * Indicate that the user is suspended.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function size($size)
    {
        return $this->state(function (array $attributes) use ($size) {
            switch ($size) {
                case 'high':
                    return [
                        'url' => $this->faker->imageUrl(1280, 720),
                        'width' => 480,
                        'height' => 360,
                        'size' => $size
                    ];
                    break;

                case 'maxres':
                    return [
                        'url' => $this->faker->imageUrl(1280, 720),
                        'width' => 1280,
                        'height' => 720,
                        'size' => $size
                    ];
                    break;
                case 'medium':
                    return [
                        'url' => $this->faker->imageUrl(1280, 720),
                        'width' => 320,
                        'height' => 180,
                        'size' => $size
                    ];
                    break;
                case 'standard':
                    return [
                        'url' => $this->faker->imageUrl(1280, 720),
                        'width' => 640,
                        'height' => 480,
                        'size' => $size
                    ];
                    break;
                default:
                    return [
                        'url' => $this->faker->imageUrl(1280, 720),
                        'width' => 120,
                        'height' => 90,
                        'size' => $size
                    ];
                    break;
            }
        });
    }
}
