<?php

namespace Database\Factories;

use App\Models\Audience;
use App\Models\Genre;
use App\Models\Country;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Movie;

class MovieFactory extends BaseFactory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Movie::class;

    /**
     * Define the model's default state.
     *
     * @return array
    */
    public function definition()
    {

        if(Country::all()->count() > 0){
            $country_code = Country::all()->random()->code;
        } else {
            $country = Country::factory()->make();
            $country_code = $country->code;
        }

        return [
            'genre_id' => $this->getRelationId(Genre::class),
            'audience_id' => $this->getRelationId(Audience::class),
            'delivery_platform' => $this->faker->randomElement(array_merge([NULL], array_keys(Movie::PLATFORMS))),
            //legacy_id
            'original_title' => $this->faker->sentence(3, true),
            'synopsis' => $this->faker->paragraph(12, true),
            'imdb_url' => $this->faker->url,
            'isan' => 'isan-' . $this->faker->unique()->numberBetween(10000, 99999),
            'eidr' => 'eidr-' . $this->faker->unique()->numberBetween(10000, 99999),
            'delivery_date' => $this->faker->date(),
            'broadcast_date' => $this->faker->date(),
            'film_length' => $this->faker->numberBetween(61, 134),
            'number_of_episodes' => $this->faker->numberBetween(2, 100),
            'length_of_episodes' => $this->faker->numberBetween(20, 90),
            'film_country_of_origin' => $country_code,
            'film_country_of_origin_2014_2020' => $country_code,
            'year_of_copyright' => $this->faker->numberBetween(2000, 2020),
            'development_costs_in_euro' => $this->faker->numberBetween(10000, 10000000),
            'film_type' => $this->faker->randomElement(array_merge([NULL], array_keys(Movie::FILM_TYPES))),
            'film_format' => $this->faker->randomElement(array_merge([NULL], array_keys(Movie::FILM_FORMATS))),
            'total_budget_currency_amount' => $this->faker->numberBetween(1000, 1000000),
            'total_budget_currency_code' => $this->faker->randomElement(array_keys(Movie::CURRENCIES)),
            'total_budget_currency_rate' => $this->faker->randomFloat(2, 1, 2),
            'total_budget_euro' => $this->faker->numberBetween(1000, 1000000),
            'dev_support_flag' => $this->faker->boolean(),
            'dev_support_reference' => $this->faker->regexify('[A-Z0-9]{10}'),
            'photography_start' => $this->faker->date(),
            'photography_end' => $this->faker->date(),
            'country_of_origin_points' => $this->faker->randomFloat(2, 1, 2),
            'user_experience' => $this->faker->randomElement(array_merge([NULL], array_keys(Movie::USER_EXPERIENCES))),
            'link_applicant_work' => $this->faker->randomElement(array_merge([NULL], array_keys(Movie::LINK_APPLICANT_WORK))),
            'link_applicant_work_person_name' => $this->faker->name,
            'link_applicant_work_person_position' => $this->faker->name,
            'link_applicant_work_person_credit' => $this->faker->name,
            'rights_origin_of_work' => $this->faker->randomElement(array_merge([NULL], array_keys(Movie::WORK_ORIGINS))),
            'rights_contract_type' => $this->faker->randomElement(array_merge([NULL], array_keys(Movie::WORK_CONTRACT_TYPES))),
            'rights_contract_start_date' => $this->faker->date(),
            'rights_contract_end_date' => $this->faker->date(),
            'rights_contract_signature_date' => $this->faker->date(),
            'rights_adapt_author_name' => $this->faker->name(),
            'rights_adapt_original_title' => $this->faker->sentence(),
            'rights_adapt_contract_type' => $this->faker->randomElement(array_merge([NULL], array_keys(Movie::WORK_CONTRACT_TYPES))),
            'rights_adapt_contract_start_date' => $this->faker->date(),
            'rights_adapt_contract_end_date' => $this->faker->date(),
            'rights_adapt_contract_signature_date' => $this->faker->date(),
        ];
    }
}
