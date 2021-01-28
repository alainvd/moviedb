<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Genre;

class GenreFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Genre::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $genre_types = [
            "Children", "Adults","PEGI OK", "PEGI 3", "PEGI 7", "PEGI 12", "PEGI 16", "PEGI 18"
        ];

        return [
            'name' => $this->faker->randomElement($genre_types),
            'type' => $this->faker->randomElement(["App\Movie","App\VideoGame"])
        ];
    }
}
