<?php

namespace Database\Factories;

use App\Media;
use App\Models\Fiche;
use App\Models\Status;
use App\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class FicheFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Fiche::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'media_id' => Media::all()->random()->id,
            'status_id' => Status::all()->random()->id,
            'created_at' => $this->faker->date(),
            'created_by' => User::all()->random()->id,
        ];
    }
}
