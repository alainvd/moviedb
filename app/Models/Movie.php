<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Crew;
use App\Models\Location;
use App\Models\Genre;
use App\Models\Person;
use App\Models\Audience;
use App\Models\Document;
use App\Models\Language;
use App\Models\Distributor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Movie extends Model
{
    use HasFactory;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Default attribute values
     */
    protected $attributes = [
        // 'european_nationality_flag' => 'New',
    ];

    protected $dates = [
        'photography_start',
        'photography_end',
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
        'photography_start' => 'date:d.m.Y',
        'photography_end' => 'date:d.m.Y',
        'rights_contract_start_date' => 'date:d.m.Y',
        'rights_contract_end_date' => 'date:d.m.Y',
        'rights_contract_signature_date' => 'date:d.m.Y',
        'rights_adapt_contract_start_date' => 'date:d.m.Y',
        'rights_adapt_contract_end_date' => 'date:d.m.Y',
        'rights_adapt_contract_signature_date' => 'date:d.m.Y',
    ];

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

    public function audience()
    {
        return $this->belongsTo(Audience::class);
    }

    public function languages()
    {
        return $this->belongsToMany(Language::class, 'movie_language');
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
                ->whereColumn('titles.id', 'crews.title_id')
                ->limit(1);
        }, 'DIRECTOR')->first();

        if ($director) {
            return $director->full_name;
        }

        return '';
    }

    static function defaultsMovie()
    {
        return [
            'total_budget_currency_code' => 'EUR',
        ];
    }
}
