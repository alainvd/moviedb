<?php

namespace Database\Factories;

use App\SalesAgent;
use App\Media;
use App\Models\Country;

class SalesAgentFactory extends BaseFactory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SalesAgent::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        if(Country::all()->count() > 0){
            $country_code1 = Country::all()->random()->code;
        } else {
            $country1 = Country::factory()->make();
            $country_code1 = $country1->code;
        }

        return [
            'media_id' => $this->getRelationId(Media::class),
            'name' => $this->faker->name,
            'country' => $country_code1,
            'contact_person' => $this->faker->name,
            'email' => $this->faker->safeEmail,
            'distribution_date' => $this->faker->date,
        ];
    }
}
