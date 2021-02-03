<?php

namespace Database\Factories;

use App\Models\Movie;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Media;
use App\Models\Document;

class DocumentFactory extends BaseFactory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Document::class;

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
