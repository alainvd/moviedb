<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Title;

class TitleFactory extends Factory
{

    public $titles = [
        [
            'name' => 'Director/Project Leader',
            'code' => 'DIRECTOR'
        ],
        [
            'name' => 'Author/(Script)writer/Creator',
            'code' => 'AUTHOR'
        ],
        [
            'name' => 'Script-editor',
            'code' => 'SCRIPTEDITOR'
        ],
    ];

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Title::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $random_element = $this->faker->randomElement($this->titles);
        return [
            'name' => $random_element['title'],
            'code' => $random_element['code'],
        ];
    }
}
