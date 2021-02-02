<?php

namespace Database\Factories;

use App\Models\Country;
use App\Models\Distributor;
use Illuminate\Database\Eloquent\Factories\Factory;

class DistributorFactory extends BaseFactory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Distributor::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'country_id' =>  $this->getRelationId(Country::class),
            'forecast_release_date' => $this->faker->date
        ];
    }
}


