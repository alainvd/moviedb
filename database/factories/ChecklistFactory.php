<?php

namespace Database\Factories;

use App\Dossier;
use App\Media;
use App\Step;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Checklist;

class ChecklistFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Checklist::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'position' => $this->faker->numberBetween(0, 100),
            'status' => $this->faker->word,
            'dossier_id' => Dossier::factory(),
            'step_id' => Step::factory(),
            'media_id' => Media::factory(),
            'status_by' => $this->faker->word,
        ];
    }
}
