<?php

namespace App\Models;

use App\Models\Dossier;
use App\Models\Movie;
use App\Models\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Models\Activity as ActivityLog;
use Spatie\Activitylog\Traits\LogsActivity;

class Fiche extends Model
{
    use HasFactory, LogsActivity;

    const TITLE_DEVCURRENT = 'Audiovisual Work - Development - For grant request';
    const TITLE_DEVPREV = 'Audiovisual Work - Development - Recent work / previous experience';
    const TITLE_DIST = 'Films - Distribution';
    const TITLE_TV = 'Audiovisual Work - Production - TV and Online';
    const TITLE_VG = 'Audiovisual Work - Production - Videogames';

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
    // protected static $submitEmptyLogs = false;
    protected static $logAttributes = [
        'status_id',
        'comments',
        'movie.genre_id',
        'movie.audience_id',
        'movie.delivery_platform',
        'movie.original_title',
        'movie.synopsis',
        'movie.imdb_url',
        'movie.isan',
        'movie.eidr',
        'movie.delivery_date',
        'movie.broadcast_date',
        'movie.film_length',
        'movie.number_of_episodes',
        'movie.length_of_episodes',
        'movie.film_country_of_origin',
        'movie.year_of_copyright',
        'movie.development_costs_in_euro',
        'movie.film_type',
        'movie.film_format',
        'movie.total_budget_currency_amount',
        'movie.total_budget_currency_code',
        'movie.total_budget_currency_rate',
        'movie.total_budget_euro',
        'movie.dev_support_flag',
        'movie.dev_support_reference',
        'movie.photography_start',
        'movie.photography_end',
        'movie.country_of_origin_points',
        'movie.user_experience',
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

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function tapActivity(ActivityLog $activity, string $eventName)
    {
        if ($eventName === 'updated') {
            // Get associated movie
            $movie = $activity->subject->movie;

            if (!$movie) {
                return;
            }

            // Get last movie log activity
            $lastMovieActivity = ActivityLog::forSubject($activity->subject->movie)->orderBy('created_at', 'desc')->first();

            // If created within one second to the new one, it means it's from the same event
            if (
                $lastMovieActivity
                && $lastMovieActivity->created_at->diffInSeconds($activity->created_at) <= 1
            ) {
                $activity->properties = collect([
                    'old' => array_merge(
                        $activity->properties['old'],
                        $lastMovieActivity->properties['old']
                    ),
                    'attributes' => array_merge(
                        $activity->properties['attributes'],
                        $lastMovieActivity->properties['attributes']
                    )
                ]);
            }
        }
    }

    static function defaultsFiche()
    {
        return [
            'status_id' => 1,
        ];
    }

    public function ficheTypeTitle()
    {
        switch ($this->type) {
            case 'dist':
                $title = Fiche::TITLE_DIST;
                break;
            case 'dev-current':
                $title = Fiche::TITLE_DEVCURRENT;
                break;
            case 'dev-prev':
                $title = Fiche::TITLE_DEVPREV;
                break;
            case 'tv':
                $title = Fiche::TITLE_TV;
                break;
            case 'vg':
                $title = Fiche::TITLE_VG;
                break;
        }
        return $title;
    }

    public function ficheTypeRoutes(Dossier $dossier = null, Activity $activity = null, Fiche $fiche)
    {
        if ($dossier && $activity && $fiche) {
            switch ($this->type) {
                case 'dist':
                    $details_route = route('dist-fiche-form', [$dossier, $activity, $fiche]);
                    $dossiers_route = route('dist-fiche-dossiers', [$dossier, $activity, $fiche]);
                    break;
                case 'dev-current':
                    $details_route = route('dev-current-fiche-form', [$dossier, $activity, $fiche]);
                    $dossiers_route = route('dev-current-fiche-dossiers', [$dossier, $activity, $fiche]);
                    break;
                case 'dev-prev':
                    $details_route = route('dev-prev-fiche-form', [$dossier, $activity, $fiche]);
                    $dossiers_route = route('dev-prev-fiche-dossiers', [$dossier, $activity, $fiche]);
                    break;
                case 'tv':
                    $details_route = route('tv-fiche-form', [$dossier, $activity, $fiche]);
                    $dossiers_route = route('tv-fiche-dossiers', [$dossier, $activity, $fiche]);
                    break;
                case 'vg':
                    // $details_route = route('vg-fiche-form', [$dossier, $activity, $fiche]);
                    // $dossiers_route = route('vg-fiche-dossiers', [$dossier, $activity, $fiche]);
                    break;
                default:
                    $details_route = null;
                    $dossiers_route = null;
                    break;
                    
            }
        } else {
            switch ($this->type) {
                case 'dist':
                    $details_route = route('movie-dist', [$fiche]);
                    $dossiers_route = route('movie-dist-dossiers', [$fiche]);
                    break;
                case 'dev-current':
                    $details_route = route('movie-dev-current', [$fiche]);
                    $dossiers_route = route('movie-dev-current-dossiers', [$fiche]);
                    break;
                case 'dev-prev':
                    $details_route = route('movie-dev-prev', [$fiche]);
                    $dossiers_route = route('movie-dev-prev-dossiers', [$fiche]);
                    break;
                case 'tv':
                    $details_route = route('movie-tv', [$fiche]);
                    $dossiers_route = route('movie-tv-dossiers', [$fiche]);
                    break;
                case 'vg':
                    // $details_route = route('movie-vg', [$fiche]);
                    // $dossiers_route = route('movie-vg-dossiers', [$fiche]);
                    break;
                default:
                    $details_route = null;
                    $dossiers_route = null;
                    break;
            }
        }
        return [
            'details_route' => $details_route,
            'dossiers_route' => $dossiers_route,
        ];
    }    
}
