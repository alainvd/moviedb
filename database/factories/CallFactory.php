<?php

namespace Database\Factories;

use App\Models\Action;
use App\Models\Call;

class CallFactory extends BaseFactory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Call::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // Call name in the format: 'H2020-LC-GD-2020-3';
        $name = sprintf(
            '%s%d-%s-%s-%d-%d',
            strtoupper($this->faker->randomLetter),
            date('Y'),
            strtoupper($this->faker->lexify('??')),
            strtoupper($this->faker->lexify('??')),
            date('Y'),
            $this->faker->randomDigitNotNull()
        );

        $action = $this->getRelation(Action::class);
        $publishedAt = $this->faker->dateTimeBetween('-3 years', 'now');

        return [
            // H2020-LC-GD-2020-3
            'name' => $name . '-' . $action->name,
            'action_id' => $action->id,
            'description' => $this->faker->text,
            'published_at' => $publishedAt,
            'status' => in_array($publishedAt->format('Y'), [date('Y') - 1, date('Y')]) ? 'open' : 'closed',
        ];
    }
}
