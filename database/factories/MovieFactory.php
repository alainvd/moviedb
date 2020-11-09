<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Movie;

class MovieFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Movie::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'imdb_url' => $this->faker->url,
            'original_title' => $this->faker->sentence(3, true),
            'shooting_start' => $this->faker->date(),
            'shooting_end' => $this->faker->date(),
            'year_of_copyright' => $this->faker->numberBetween(2000, 2020),
            'european_nationality_flag' => 'OK',
            'film_country_of_origin' => $this->faker->randomElement(["BE", "FR", "NL"]),
            'isan' => 'isan-' . $this->faker->unique()->numberBetween(10000, 99999),
            'eidr' => 'eidr-' . $this->faker->unique()->numberBetween(10000, 99999),
        ];


    }
}
