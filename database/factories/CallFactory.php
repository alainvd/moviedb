<?php

namespace Database\Factories;

use App\Models\Action;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Call;

class CallFactory extends Factory
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
        $actions = [
            "DEVSLATE",
            "DEVSPANI",
            "DEVSPDOC",
            "DEVSPFIC",
            "DEVVG",
            "DISTAUTOG",
            "DISTAUTOR1",
            "DISTAUTOR2",
            "DISTAUTOR3",
            "DISTSAG",
            "DISTSAR1",
            "DISTSAR2",
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

        return [
            // H2020-LC-GD-2020-3
            'name' => $name,
            // 'action' => $this->faker->randomElement($actions),
            'action' => 'DEVSLATE',
            'description' => $this->faker->text,
            'published_at' => $this->faker->dateTime(),
            'status' => $this->faker->randomElement(["open","closed"]),
        ];
    }
}
