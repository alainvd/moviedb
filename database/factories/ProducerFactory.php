<?php

namespace Database\Factories;

use App\Producer;
use App\Media;
use App\Models\Country;

class ProducerFactory extends BaseFactory
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
            'media_id' => $this->getRelationId(Media::class),
            'role' => $this->faker->randomElement(["producer", "coproducer"]),
            'name' => $this->faker->name,
            'city' => $this->faker->city,
            'country_id' => $this->getRelationId(Country::class),
            'share' => $this->faker->numberBetween(0, 100),
            'budget' => $this->faker->numberBetween(1, 100000),
        ];
    }
}
