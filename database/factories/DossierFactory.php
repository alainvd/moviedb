<?php

namespace Database\Factories;

use App\Models\Call;
use App\Models\Dossier;
use App\Models\Action;
use App\Models\Status;
use App\Models\User;

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

        $call = $this->getRelation(Call::class);

        return [
            'project_ref_id' => $ref,
            'action_id' => $call->action_id,
            'year' => $this->faker->numberBetween(1990, 2020),
            'status_id' => $this->getRelationId(Status::class),
            'call_id' => $call->id,
            'contact_person' => $this->faker->safeEmail,
            'company' => $this->faker->company,
            'created_by' => $this->getRelationId(User::class),
        ];
    }
}
