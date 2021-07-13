<?php

namespace Database\Factories;

use App\Models\Call;
use App\Models\User;
use App\Models\Action;
use App\Models\Status;
use App\Models\Country;
use App\Models\Dossier;

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

        if(Country::all()->count() > 0){
            $country_code1 = Country::all()->random()->code;
        } else {
            $country1 = Country::factory()->make();
            $country_code1 = $country1->code;
        }

        return [
            'project_ref_id' => $ref,
            'action_id' => $call->action_id,
            'status_id' => $this->getRelationId(Status::class),
            'year' => $this->faker->numberBetween(1990, 2020),
            'call_id' => $call->id,
            'contact_person' => $this->faker->safeEmail,
            'pic' => $this->faker->numberBetween(100000,999999),
            'company' => $this->faker->company,
            'country' => $country_code1,
            'created_at' => $this->faker->dateTimeBetween('- 1 month', 'now'),
            'created_by' => $this->getRelationId(User::class),
        ];
    }
}
