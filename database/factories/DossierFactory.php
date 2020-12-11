<?php

namespace Database\Factories;

use App\Call;
use App\Dossier;
use App\Models\Status;

class DossierFactory extends BaseFactory
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
            'status_id' => $this->getRelationId(Status::class),
            'call_id' => $this->getRelationId(Call::class),
        ];
    }
}
