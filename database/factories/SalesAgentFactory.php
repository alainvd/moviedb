<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\SalesAgent;
use App\Media;
use App\Models\Country;

class SalesAgentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SalesAgent::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'media_id' => Media::factory(),
            'name' => $this->faker->name,
            'country_id' => Country::factory(),
            'contact_person' => $this->faker->word,
            'email' => $this->faker->safeEmail,
        ];
    }
}
