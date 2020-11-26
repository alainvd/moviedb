<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Title;

class TitleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Title::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $title_types = ['Director', 'Screenwriter', 'Actor'];

        return [
            'name' => $this->faker->randomElement($title_types),
        ];
    }
}
