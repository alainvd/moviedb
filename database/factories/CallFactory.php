<?php

namespace Database\Factories;

use App\Models\Action;
use App\Models\Call;
use Carbon\Carbon;
use DateInterval;

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
        $publishedAt = $this->faker->dateTimeBetween('-1 years', 'now');
        $deadline1 = $this->faker->dateTimeBetween(
            $publishedAt,
            $publishedAt->add(new DateInterval('P6M'))
        );

        return [
            // H2020-LC-GD-2020-3
            'name' => $name . '-' . $action->name,
            'action_id' => $action->id,
            'year' => $this->faker->numberBetween(1990, 2020),
            'description' => $this->faker->text,
            'published_at' => $publishedAt,
            'deadline1' => null,
            'status' => null,
            // 'status' => $deadline1->diff(Carbon::now())->invert ? 'open' : 'closed',
        ];
    }
}
