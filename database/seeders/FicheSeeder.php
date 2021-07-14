<?php

namespace Database\Seeders;

use App\Models\Activity;
use App\Models\Dossier;
use App\Models\Fiche;
use App\Models\Movie;
use App\Models\Status;
use App\Models\User;
use Illuminate\Database\Seeder;
use Exception;
use Illuminate\Database\Eloquent\Model;

class FicheSeeder extends Seeder
{

    /**
     * Get a relation id if exists, or factory
     */
    protected function getRelationId($model)
    {
        return $this->getRelation($model)->id;
    }

    protected function getRelation($model)
    {
        $model = new $model;

        if (!$model instanceof Model) {
            throw new Exception("Provided {$model} is not an Eloquent model instance");
        }

        if (get_class($model) == "App\Models\Movie") {
            return $model->factory()->create();
        }

        if ($model->all()->count() > 0) {
            return $model->all()->random();
        } else {
            return $model->factory()->create();
        }
    }

    protected function dossierCreateFiches($action, $type, $activity) {
        Dossier::where('action_id', $action)->each(function ($dossier) use ($type, $activity) {
            $dossier->fiches()->attach(
                Fiche::create([
                    'movie_id' => $this->getRelationId(Movie::class),
                    'status_id' => $this->getRelationId(Status::class),
                    'type' => $type,
                    'created_by' => $dossier->createdBy->id,
                ]),
                ['activity_id' => $activity]
            );
        });
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // for dossier with action: 1 (devslate)
        // attach fiche - type:dev-prev, activity:2
        // attach fiche - type:dev-current, activity:3
        // attach fiche - type:dev-current, activity:5
        $this->dossierCreateFiches(1, 'dev-prev', 2);
        $this->dossierCreateFiches(1, 'dev-current', 3);
        $this->dossierCreateFiches(1, 'dev-current', 5);
        // for dossier with action: 2 (devminislate)
        // attach fiche - type:dev-prev, activity:2
        // attach fiche - type:dev-current, activity:3
        // attach fiche - type:dev-current, activity:5 - short film
        $this->dossierCreateFiches(2, 'dev-prev', 2);
        $this->dossierCreateFiches(2, 'dev-current', 3);
        $this->dossierCreateFiches(2, 'dev-current', 5);
        // for dossier with action: 3 (codev)
        // attach fiche - type:dev-prev, activity:2
        // attach fiche - type:dev-current, activity:3
        $this->dossierCreateFiches(3, 'dev-prev', 2);
        $this->dossierCreateFiches(3, 'dev-current', 3);
        // for dossier with action: 4 (vg)
        // attach fiche - type:vg-prev, activity:1
        // attach fiche - type:vg-current, activity:1
        $this->dossierCreateFiches(4, 'vg-prev', 1);
        $this->dossierCreateFiches(4, 'vg-current', 1);
        // for dossier with action: 5 (distsag)
        // attach fiche - type:dist, activity:NULL
        $this->dossierCreateFiches(5, 'dist', null);
        // for dossier with action: 6 (filmove)
        // attach fiche - type:dist, activity:NULL
        $this->dossierCreateFiches(6, 'dist', null);
        // for dossier with action: 7 (tvonline)
        // attach fiche - type:tv, activity:3
        $this->dossierCreateFiches(7, 'tv', 3);
    }
}

/**
 * dossier > fiche > movie
 */
