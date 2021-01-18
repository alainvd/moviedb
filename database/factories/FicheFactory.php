<?php

namespace Database\Factories;

use App\Dossier;
use App\Media;
use App\Models\Fiche;
use App\Models\Status;
use App\User;

class FicheFactory extends BaseFactory
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
            'media_id' => $this->getRelationId(Media::class),
            'dossier_id' => $this->getRelationId(Dossier::class),
            'status_id' => $this->getRelationId(Status::class),
            'created_by' => $this->getRelationId(User::class),
            'comments' => $this->faker->text(),
        ];
    }
}
