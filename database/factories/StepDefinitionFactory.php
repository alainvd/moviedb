<?php

namespace Database\Factories;

use App\Step;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\StepDefinition;

class StepDefinitionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = StepDefinition::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'action' => $this->faker->word,
            'step_id' => Step::factory(),
            'position' => $this->faker->numberBetween(1, 200),
            'version' => $this->faker->numberBetween(1, 10),
        ];
    }
}
