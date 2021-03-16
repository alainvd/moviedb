<?php

namespace Database\Factories;

use App\Models\Location;
use App\Models\Movie;
use App\Models\Country;
use Illuminate\Database\Eloquent\Factories\Factory;

class LocationFactory extends BaseFactory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Location::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        if(Country::all()->count() > 0){
            $country_code = Country::all()->random()->code;
        } else {
            $country = Country::factory()->make();
            $country_code = $country->code;
        }

        return [
            'movie_id' => $this->getRelationId(Movie::class),
            'type' => $this->faker->randomElement(['SHOOT', 'POST', 'STUDIO']),
            'name' => $this->faker->name,
            'country' => $country_code,
            'points' => $this->faker->randomFloat(2, 0, 10),
        ];
    }
}
