<?php

namespace Database\Factories;

use App\Models\Status;
use Illuminate\Database\Eloquent\Factories\Factory;

class StatusFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Status::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->randomElement(['Draft', 'New', 'Accepted', 'Rejected', 'Duplicated', 'Distinct', 'Missing information', 'Validated', 'OK', 'Not OK', 'Qualified AO']);

        return [
            'name' => $name,
            'public' => $this->faker->boolean(60),
            'public_name' => $this->faker->randomElement([null, $name]),
            'created_at' => $this->faker->date,
        ];
    }
}
