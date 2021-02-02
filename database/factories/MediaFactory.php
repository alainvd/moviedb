<?php

namespace Database\Factories;

use App\Models\Audience;
use App\Models\Genre;
use App\Media;
use App\Models\Status;
use App\Models\User;

class MediaFactory extends BaseFactory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Media::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(4),
            'audience_id' => $this->getRelationId(Audience::class),

            'grantable_id' => $this->faker->numberBetween(1,5),
            'grantable_type' => $this->faker->randomElement(["App\Models\Movie","App\Models\VideoGame"]),
            'delivery_platform_id' => $this->faker->numberBetween(0, 2),
        ];
    }
}
