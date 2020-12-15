<?php

namespace Database\Factories;

use App\Models\Country;
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

        if(Country::all()->count() > 0){
            $country_name = Country::all()->random()->name;
        } else {
            $country = Country::factory()->make();
            $country_name = $country->name;
        }

        return [
            'imdb_url' => $this->faker->url,
            'original_title' => $this->faker->sentence(3, true),
            'shooting_start' => $this->faker->date(),
            'shooting_end' => $this->faker->date(),
            'year_of_copyright' => $this->faker->numberBetween(2000, 2020),
            'european_nationality_flag' => $this->faker->randomElement(['OK', 'Not OK', 'Under processing', 'Missing information']),
            'film_country_of_origin' => $country_name,
            'isan' => 'isan-' . $this->faker->unique()->numberBetween(10000, 99999),
            'eidr' => 'eidr-' . $this->faker->unique()->numberBetween(10000, 99999),
            'film_type' => $this->faker->randomElement(['One-off', 'Series']),
            'film_length' => $this->faker->numberBetween(61, 134),
            'film_format' => $this->faker->randomElement(['35mm', 'Digital', 'Other']),
            'synopsis' => $this->faker->paragraph(12, true),
        ];
    }
}
