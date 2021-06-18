<?php

namespace Database\Factories;

use App\Models\Reinvested;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReinvestedFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Reinvested::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'fiche_id' => $this->faker->randomNumber(),
            'type_subtype' => $this->faker->word,
            'grant' => $this->faker->numberBetween(-100000, 100000),
        ];
    }
}
