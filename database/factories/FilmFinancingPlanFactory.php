<?php

namespace Database\Factories;

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
            'media_id' => $this->getRelationId(Media::class),
            'document_type' => $this->faker->word,
            'filename' => $this->faker->word,
            'comments' => $this->faker->sentence,
        ];
    }
}
