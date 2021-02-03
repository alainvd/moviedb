<?php

namespace Database\Factories;

use App\Models\Call;
use App\Models\Dossier;
use App\Models\Action;
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
        $ref = sprintf('SEP-%d', $this->faker->randomNumber(9));

        return [
            'project_ref_id' => $ref,
            'action_id' => $this->getRelationId(Action::class),
            'year' => $this->faker->numberBetween(1990, 2020),
            'status_id' => $this->getRelationId(Status::class),
            'call_id' => $this->getRelationId(Call::class),
            'contact_person' => $this->faker->safeEmail,
            'company' => $this->faker->company,
        ];
    }
}
