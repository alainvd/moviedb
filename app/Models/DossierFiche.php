<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Support\Facades\Auth;

class DossierFiche extends Pivot
{
    use HasFactory;

    public $timestamps = false;

    protected static function booted()
    {
        static::created(function ($pivot) {
            if ($pivot->activity_id == 2) {
                $model = 'Previous Work';
            } else if ($pivot->activity_id == 3) {
                $model = 'Current Work';
            } else if ($pivot->activity_id == 5) {
                $model = 'Short Film';
            }

            activity()->on(Dossier::find($pivot->dossier_id))
                ->by(Auth::user())
                ->withProperties([
                    'model' => $model,
                    'operation' => 'added',
                    'movie' => Fiche::find($pivot->fiche_id)->movie->toArray(),
                ])
                ->log('updated');
        });
    }
}
