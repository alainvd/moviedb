<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\AdmissionsTable;

class AdmissionsTableFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AdmissionsTable::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'dossier_id' => $this->faker->randomNumber(),
            'country_id' => $this->faker->randomNumber(),
            'year' => $this->faker->numberBetween(-10000, 10000),
        ];
    }
}
