<?php

namespace Database\Factories;

use App\Dossier;
use App\Media;
use App\Step;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Checklist;

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
            'media_id' => $this->getRelationId(Media::class),
            'status_by' => $this->faker->word,
        ];
    }
}
