<?php

namespace Database\Factories;

use App\Movie;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Media;
use App\FilmFinancingPlan;

class FilmFinancingPlanFactory extends BaseFactory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = FilmFinancingPlan::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'movie_id' => $this->getRelationId(Movie::class),
            'document_type' => $this->faker->word,
            'filename' => $this->faker->word,
            'comments' => $this->faker->sentence,
        ];
    }
}
