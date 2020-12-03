<?php

namespace Database\Factories;

use App\Call;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Dossier;
use App\Models\Status;

class DossierFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Dossier::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'project_ref_id' => $this->faker->word,
            'action' => $this->faker->word,
            'year' => $this->faker->numberBetween(1990, 2020),
            'status_id' => Status::all()->random()->id,
            'call_id' => Call::factory(),
        ];
    }
}
