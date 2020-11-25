<?php

namespace Database\Factories;

use App\Audience;
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
        return [
            'title' => $this->faker->sentence(4),
            'audience_id' => Audience::all()->random()->id,
            'grantable_id' => $this->faker->numberBetween(1,5),
            'grantable_type' => $this->faker->randomElement(["App\Movie","App\Videogame"])
        ];
    }
}
