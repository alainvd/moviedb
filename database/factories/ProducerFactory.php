<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Producer;
use App\Media;
use App\Models\Country;

class ProducerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Producer::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'media_id' => Media::factory(),
            'role' => $this->faker->randomElement(["producer","coproducer"]),
            'name' => $this->faker->name,
            'city' => $this->faker->city,
            'country_id' => Country::factory(),
            'share' => $this->faker->numberBetween(0, 100),
            'budget' => $this->faker->numberBetween(0, 10000),
        ];
    }
}
