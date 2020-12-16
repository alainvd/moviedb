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
        return [
            'media_id' => $this->getRelationId(Media::class),
            'name' => $this->faker->name,
            'country_id' => $this->getRelationId(Country::class),
            'contact_person' => $this->faker->name,
            'email' => $this->faker->safeEmail,
        ];
    }
}
