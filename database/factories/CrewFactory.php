<?php

namespace Database\Factories;

use App\Media;
use App\Person;
use App\Title;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Crew;

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
            'points' => $this->faker->numberBetween(0, 10),
            'person_id' => Person::factory(),
            'title_id' => $this->getRelationId(Title::class),
            'media_id' => Media::factory(),
        ];
    }
}
