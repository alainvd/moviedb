<?php

namespace App\Models;

use App\Models\Crew;
use App\Models\Genre;
use App\Models\Person;
use App\Models\Audience;
use App\Models\Document;
use App\Models\Language;
use App\Models\Location;
use App\Models\Distributor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\Models\Activity as ActivityLog;

class Movie extends Model
{
    use HasFactory, LogsActivity;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    protected static $logUnguarded = true;
    protected static $logOnlyDirty = true;
    protected static $submitEmptyLogs = false;
    protected static $recordEvents = ['updated'];

    /**
     * Default attribute values
     */
    protected $attributes = [
    ];

    protected $appends = [
        'director',
    ];

    protected $dates = [
        'photography_start',
        'photography_end',
        'delivery_date',
        'broadcast_date',
        'rights_contract_start_date',
        'rights_contract_end_date',
        'rights_contract_signature_date',
        'rights_adapt_contract_start_date',
        'rights_adapt_contract_end_date',
        'rights_adapt_contract_signature_date',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
    ];

    const PLATFORMS = [
        'CINEMA' => 'Features / Cinema',
        'TV' => 'TV',
        'DIGITAL' => 'Digital',
    ];

    const FILM_FORMATS = [
        '35MM' => '35mm',
        'DIGITAL' => 'Digital',
        'OTHER' => 'Other',
    ];

    const FILM_TYPES = [
        'ONEOFF' => 'One-off',
        'SERIES' => 'Series',
        'SHORT' => 'Short film',
    ];

    const CURRENCIES = [
        'EUR' => 'Euro',
        'USD' => 'US dollar',
        'JPY' => 'Japanese yen',
        'GBP' => 'Pound sterling',
        'CHF' => 'Swiss franc',
        'SEK' => 'Swedish krona',
    ];

    const LINK_APPLICANT_WORK = [
        'WRKPRODAP' => 'Work Produced by the Applicant Company',
        'WRKPERS' => 'Work where Personal Credit is Eligible',
        'WRKCOPROD' => 'Co-production with Another Company'
    ];

    const USER_EXPERIENCES = [
        'LINEAR' => 'Linear',
        'INTERACTIVE' => 'Interactive, non-linear (VR)'
    ];

    const WORK_ORIGINS = [
        'ORIGINAL' => 'Original Work',
        'ADAPTATION' => 'Adaptation'
    ];

    const WORK_CONTRACT_TYPES = [
        'CTONRTRANS' => 'Contract of transfer of rights',
        'PUBLIDOM' => 'Public domain',
        'OPTAGR' => 'Option Agreement of transfer of rights',
        'UNILATDECL' => 'Unilateral declaration of transfer of rights',
        'COPRODDEV' => 'Co-Production/co-development agreement',
    ];

    const DOCUMENT_TYPES = [
        'FINANCING' => 'Financing plan',
        'OTHER' => 'Other',
    ];

    CONST PRODUCER_ROLES = [
        'PRODUCER' => 'Producer',
        'COPRODUCER' => 'Coproducer',
    ];



    CONST GAME_MODES = [
        'SINGLE' => 'Single Player',
        'MULTI' => 'Multi Player',
    ];

    public function status()
    {
        return $this->hasOneThrough(Status::class, Fiche::class, 'movie_id', 'id', 'id', 'status_id');
    }

    public function crew()
    {
        return $this->hasMany(Crew::class, 'movie_id', 'id');
    }

    public function location()
    {
        return $this->hasMany(Location::class, 'movie_id', 'id');
    }

    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }

    public function gameGenres()
    {
        return $this->belongsToMany(Genre::class,'movie_game_genres' );
    }

    public function audience()
    {
        return $this->belongsTo(Audience::class);
    }

    public function languages()
    {
        return $this->belongsToMany(Language::class, 'movie_language');
    }

    public function gameOptions()
    {
        return $this->belongsToMany(GameOption::class, 'movie_game_options');
    }

    public function gameModes()
    {
        return $this->belongsToMany(GameMode::class, 'movie_game_modes');
    }

    public function gamePlatforms()
    {
        return $this->belongsToMany(GamePlatform::class, 'movie_game_platforms');
    }

    public function crews()
    {
        return $this->hasMany(Crew::class);
    }

    public function people()
    {
        return $this->hasManyThrough(Person::class, Crew::class, 'movie_id', 'id', 'id', 'person_id');
    }

    public function distributors()
    {
        return $this->belongsToMany(Distributor::class);
    }

    public function documents()
    {
        return $this->hasMany(Document::class, 'movie_id', 'id');
    }

    public function fiche()
    {
        return $this->hasOne(Fiche::class);
    }

    public function getTitleAttribute(){
        return $this->original_title;
    }

    public function getDirectorAttribute()
    {
        $director = $this->people()->where(function ($query) {
            $query->select('code')
                ->from('titles')
                ->whereColumn('titles.id', 'crews.title_id');
        }, 'DIRECTOR')->first();

        if ($director) {
            return $director->full_name;
        }

        return '';
    }

    public function scopeGroupedDirectorNames($query, $alias)
    {
        $query->addSelect([
            $alias => Person::selectRaw('GROUP_CONCAT(firstname, " ", lastname SEPARATOR " , ")')
                ->leftJoin('crews', 'crews.person_id', 'people.id')
                ->whereColumn('crews.movie_id', 'movies.id')
                ->where('crews.title_id', '=', 1)
        ]);
    }

    public function scopeFilterGroupedDirectorNames($query, $value)
    {
        $query->whereHas('people', function ($query) use ($value) {
            /*$query->where('people.id', $value);*/
            $query
            ->leftJoin('crews', 'crews.person_id', 'people.id')
            ->whereRaw("CONCAT(crew.people.firstname,'',crew.people.lastname) = '$value'");

        });
    }

    public function scopeForDirector($query, $director)
    {
        return $query->where(function ($query) use ($director) {
            $query->select('titles.code')
                ->from('crews')
                ->join('people', 'people.id', '=', 'crews.person_id')
                ->join('titles', 'titles.id', '=', 'crews.title_id')
                ->whereColumn('crews.movie_id', 'movies.id')
                ->whereRaw("CONCAT(people.firstname, ' ', people.lastname) like '%{$director}%'")
                ->limit(1);
            }, 'DIRECTOR');
    }

    public function scopeForStatusId($query, $statusId)
    {
        return $query->where(function ($query) {
            $query->select('fiches.status_id')
                ->from('fiches')
                ->whereColumn('fiches.movie_id', 'movies.id')
                ->limit(1);
        }, $statusId);
    }

    static function defaultsMovie()
    {
        return [
            'total_budget_currency_code' => 'EUR',
        ];
    }

    public function getPhotographyStartAttribute($value)
    {
        return $value ? date('d.m.Y', strtotime($value)) : null;
    }

    public function getPhotographyEndAttribute($value)
    {
        return $value ? date('d.m.Y', strtotime($value)) : null;
    }

    public function getDeliveryDateAttribute($value)
    {
        return $value ? date('d.m.Y', strtotime($value)) : null;
    }

    public function getBroadcastDateAttribute($value)
    {
        return $value ? date('d.m.Y', strtotime($value)) : null;
    }

    public function getRightsContractStartDateAttribute($value)
    {
        return $value ? date('d.m.Y', strtotime($value)) : null;
    }

    public function getRightsContractEndDateAttribute($value)
    {
        return $value ? date('d.m.Y', strtotime($value)) : null;
    }

    public function getRightsContractSignatureDateAttribute($value)
    {
        return $value ? date('d.m.Y', strtotime($value)) : null;
    }

    public function getRightsAdaptContractStartDateAttribute($value)
    {
        return $value ? date('d.m.Y', strtotime($value)) : null;
    }

    public function getRightsAdaptContractEndDateAttribute($value)
    {
        return $value ? date('d.m.Y', strtotime($value)) : null;
    }

    public function getRightsAdaptContractSignatureDateAttribute($value)
    {
        return $value ? date('d.m.Y', strtotime($value)) : null;
    }
}
