<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Person;

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
        $lastname = $this->faker->lastName;
        $firstname = $this->faker->firstName;
        return [
            'lastname' => $lastname,
            'firstname' => $firstname,
            'fullname' => $firstname . " " . $lastname,
            'gender' => $this->faker->word,
            'nationality1' => $this->faker->word,
            'nationality2' => $this->faker->word,
            'country_of_residence' => $this->faker->word,
        ];
    }
}
