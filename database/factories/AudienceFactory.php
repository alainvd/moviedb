<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Audience;

class AudienceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Audience::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $audience_types = [
            "Children", "Adults","PEGI OK", "PEGI 3", "PEGI 7", "PEGI 12", "PEGI 16", "PEGI 18"
        ];

        return [
            'name' => $this->faker->randomElement($audience_types),
            'type' => $this->faker->randomElement(["App\Movie","App\Videogame"])
        ];
    }
}
