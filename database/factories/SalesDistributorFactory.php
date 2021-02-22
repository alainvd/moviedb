<?php

namespace Database\Factories;

use App\Models\Movie;
use App\Models\SalesDistributor;

class SalesDistributorFactory extends BaseFactory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SalesDistributor::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'movie_id' => $this->getRelationId(Movie::class),
            'name' => $this->faker->name,
            'role' => $this->faker->randomElement(['PLATFORM', 'DISTRIBUTOR', 'BROADCASTER']),
            'release_date' => $this->faker->date(),
        ];
    }
}
