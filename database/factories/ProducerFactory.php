<?php

namespace Database\Factories;

use App\Producer;
use App\Media;
use App\Models\Country;
use App\Models\Language;

class ProducerFactory extends BaseFactory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Producer::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        if(Country::all()->count() > 0){
            $country_code1 = Country::all()->random()->code;
        } else {
            $country1 = Country::factory()->make();
            $country_code1 = $country1->code;
        }

        if(Language::all()->count() > 0){
            $language_code1 = Language::all()->random()->code;
        } else {
            $langauge1 = Country::factory()->make();
            $language_code1 = $langauge1->code;
        }

        return [
            'media_id' => $this->getRelationId(Media::class),
            'role' => $this->faker->randomElement(["PRODUCER", "COPRODUCER"]),
            'name' => $this->faker->name,
            'city' => $this->faker->city,
            'country' => $country_code1,
            'language' => $language_code1,
            'share' => $this->faker->numberBetween(0, 100),
            'budget' => $this->faker->numberBetween(1, 100000),
        ];
    }
}
