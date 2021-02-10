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
        $codes = [
            "DEVSLATE",
            "DEVSLATEEU",
            "DEVSLATEEUMINI",
            "EUCODEV",
            // "DEVSPANI",
            // "DEVSPDOC",
            // "DEVSPFIC",
            "DEVVG",
            // "DISTAUTOG",
            // "DISTAUTOR1",
            // "DISTAUTOR2",
            // "DISTAUTOR3",
            "DISTSAG",
            // "DISTSAR1",
            // "DISTSAR2",
            "DISTSEL",
            "TV"
        ];

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

        return [
            // H2020-LC-GD-2020-3
            'name' => $name . '-' . $action->name,
            'action_id' => $action->id,
            'description' => $this->faker->text,
            'published_at' => $this->faker->dateTime(),
            'status' => $this->faker->randomElement(["open","closed"]),
        ];
    }
}
