<?php

namespace Database\Factories;

use App\Audience;
use App\Genre;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Media;

class MediaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Media::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        if(Audience::all()->count() > 0){
            $audience = Audience::all()->random()->id;
            $genre = Genre::all()->random()->id;
        } else {
            $audience = Audience::factory();
            $genre = Genre::factory();
        }

        return [
            'title' => $this->faker->sentence(4),
            'audience_id' => $audience,
            'genre_id' => $genre,
            'grantable_id' => $this->faker->numberBetween(1,5),
            'grantable_type' => $this->faker->randomElement(["App\Movie","App\Videogame"])
        ];
    }
}
