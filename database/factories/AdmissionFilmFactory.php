<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\AdmissionFilm;

class AdmissionFilmFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AdmissionFilm::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'admission_id' => $this->faker->randomNumber(),
            'fiche_id' => $this->faker->randomNumber(),
            'local_title' => $this->faker->word,
            'release_date' => $this->faker->date(),
            'running_weeks' => $this->faker->numberBetween(-10000, 10000),
            'certified_admissions' => $this->faker->numberBetween(-10000, 10000),
            'screens_first_week' => $this->faker->numberBetween(-10000, 10000),
            'screens_widest_release_week' => $this->faker->numberBetween(-10000, 10000),
            'box_office_receipts' => $this->faker->numberBetween(-100000, 100000),
            'eligibility_european_criteria_film' => $this->faker->boolean,
            'eligibility_year_copyright' => $this->faker->boolean,
            'eligibility_release_date' => $this->faker->boolean,
            'eligibility_european_criteria_distributor' => $this->faker->boolean,
            'eligibility_legal_status' => $this->faker->boolean,
            'eligibility_length' => $this->faker->boolean,
            'eligibility_european_nonnational_film' => $this->faker->boolean,
            'eligibility_other_criteria' => $this->faker->boolean,
            'eligibility_global_status' => $this->faker->boolean,
            'eligibility_justification' => $this->faker->word,
            'comments' => $this->faker->text,
        ];
    }
}
