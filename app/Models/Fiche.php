<?php

namespace App\Models;

use App\Models\Dossier;
use App\Models\Movie;
use App\Models\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Fiche extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'movie_id',
        'dossier_id',
        'activity_id',
        'status_id',
        'created_by',
        'updated_by',
        'comments',
        'type',
    ];

    protected static $logOnlyDirty = true;
    protected static $logAttributes = [
        'status_id',
        'comments',
        'movie.genre_id',
        'movie.audience_id',
        'movie.delivery_platform',
        'movie.original_title',
        'movie.imdb_url',
        'movie.isan',
        'movie.eidr',
        'movie.shooting_start',
        'movie.shooting_end',
        'movie.delivery_date',
        'movie.broadcast_date',
        'movie.film_length',
        'movie.number_of_episodes',
        'movie.length_of_episodes',
        'movie.film_country_of_origin',
        'movie.year_of_copyright',
        'movie.directors_film',
        'movie.development_costs_in_euro',
        'movie.production_costs_currency_date',
        'movie.production_costs_currency',
        'movie.production_costs',
        'movie.production_costs_in_euro',
        'movie.film_type',
        'movie.film_format',
        'movie.total_budget_currency_amount',
        'movie.total_budget_currency_code',
        'movie.total_budget_currency_rate',
        'movie.total_budget_euro',
        'movie.photography_start',
        'movie.photography_end',
        'movie.film_score',
        'movie.country_of_origin_points',
        'movie.synopsis',
    ];

    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }

    public function dossiers()
    {
        return $this->belongsToMany(Dossier::class)
            ->withPivot('activity_id')
            ->using(DossierFiche::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function scopeForActivity($query, $activityId)
    {
        return $query->where('dossier_fiche.activity_id', $activityId);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
