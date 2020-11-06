<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Call;
use App\Submission;

class SubmissionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Submission::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'project_ref_id' => $this->faker->word,
            'status' => $this->faker->randomElement(["accepted","rejected"]),
            'call_id' => Call::factory(),
        ];
    }
}
