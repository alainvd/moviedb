<?php

namespace Database\Factories;

use App\Models\Dossier;
use App\Models\Movie;
use App\Models\Step;
use App\Models\Checklist;

class ChecklistFactory extends BaseFactory
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
            'dossier_id' => $this->getRelationId(Dossier::class),
            'step_id' => $this->getRelationId(Step::class),
            'movie_id' => $this->getRelationId(Movie::class),
            'status_by' => $this->faker->word,
        ];
    }
}
