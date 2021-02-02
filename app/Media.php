<?php

namespace App;

use App\Models\Distributor;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'logline',
        'audience_id',
        'genre_id',
        'grantable_id',
        'grantable_type',
        'audience_id',
        'delivery_platform_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
    ];

//    public function genre()
//    {
//        return $this->belongsTo('App\Genre');
//    }

//    public function audience()
//    {
//        return $this->belongsTo('App\Audience');
//    }

//    public function grantable()
//    {
//        return $this->morphTo();
//    }

    public function fiche()
    {
        return $this->hasOne('App\Models\Fiche');
    }

//    public function crews()
//    {
//        return $this->hasMany(Crew::class);
//    }

//    public function people()
//    {
//        return $this->hasManyThrough(\App\Person::class, \App\Crew::class, 'media_id', 'id', 'id', 'person_id');
//    }
//
//    public function distributors()
//    {
//        return $this->belongsToMany(Distributor::class);
//    }
//
//    public function filmFinancingPlans()
//    {
//        return $this->hasMany(\App\FilmFinancingPlan::class, 'media_id', 'id');
//    }

    public function getDirectorName()
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
