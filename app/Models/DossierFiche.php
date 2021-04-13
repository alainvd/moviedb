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
            // Log current / previous / short film added
            if (in_array($pivot->activity_id, [2,3,5])) {
                $fiche = Fiche::find($pivot->fiche_id);
                activity()->on(Dossier::find($pivot->dossier_id))
                    ->by(User::find($fiche->created_by))
                    ->withProperties([
                        'model' => Activity::find($pivot->activity_id)->log_model,
                        'operation' => 'added',
                        'movie' => $fiche->movie->only(['id', 'original_title', 'year_of_copyright', 'isan', 'imdb_url', 'synopsis']),
                    ])
                    ->log('updated');
            }
        });
    }
}
