<?php

namespace Database\Factories;

use App\Media;
use App\Models\Movie;
use App\Models\Person;
use App\Models\Title;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Crew;

class CrewFactory extends BaseFactory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Crew::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'points' => $this->faker->randomFloat(2, 0, 10),
            'person_id' => $this->getRelationId(Person::class),
            'title_id' => $this->getRelationId(Title::class),
            'movie_id' => $this->getRelationId(Movie::class),
        ];
    }
}
