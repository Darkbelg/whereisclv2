<?php

namespace Database\Factories;

use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Event::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(4),
            'date' => Carbon::now()->subWeek()->format('Y-m-d H:i:s'),
            'location' => $this->faker->sentence,
            'latitude' => $this->faker->randomFloat(5,-85,85),
            'longitude' => $this->faker->randomFloat(5,-180,180),
        ];
    }
}
