<?php

namespace App\Models;

use App\Models\Distributor;
use App\Models\Language;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        return $this->hasMany(\App\Models\Crew::class, 'movie_id', 'id');
    }

    public function genre()
    {
        return $this->belongsTo('App\Models\Genre');
    }

    public function audience()
    {
        return $this->belongsTo('App\Models\Audience');
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
        return $this->hasManyThrough(\App\Models\Person::class, \App\Models\Crew::class, 'movie_id', 'id', 'id', 'person_id');
    }

    public function distributors()
    {
        return $this->belongsToMany(Distributor::class);
    }

    public function filmFinancingPlans()
    {
        return $this->hasMany(\App\Models\FilmFinancingPlan::class, 'movie_id', 'id');
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
}
