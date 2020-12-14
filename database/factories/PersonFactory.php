<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Person;
use App\Models\Country;

class PersonFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Person::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $genders = [
            'male', 'female', 'na',
        ];

        if(Country::all()->count() > 0){
            $country_code1 = Country::all()->random()->code;
            $country_code2 = Country::all()->random()->code;
            $country_code3 = Country::all()->random()->code;
        } else {
            $country1 = Country::factory()->make();
            $country_code1 = $country1->code;
            $country2 = Country::factory()->make();
            $country_code2 = $country2->code;
            $country3 = Country::factory()->make();
            $country_code3 = $country3->code;
        }

        return [
            'lastname' => $this->faker->lastName,
            'firstname' => $this->faker->firstName,
            'gender' => $this->faker->randomElement($genders),
            'nationality1' => $country_code1,
            'nationality2' => $country_code2,
            'country_of_residence' => $country_code3,
        ];
    }
}
