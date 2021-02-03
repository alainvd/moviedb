<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Crew extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'points',
        'person_id',
        'title_id',
        'media_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
    ];


    public function title()
    {
        return $this->belongsTo(\App\Title::class);
    }

    public function person()
    {
        return $this->hasOne(\App\Person::class, 'id', 'person_id');
    }

    public function media()
    {
        return $this->belongsTo(\App\Media::class);
    }

    static function defaultsCrew()
    {
        return [
            'points' => null,
            'person' => [
                'firstname' => '',
                'lastname' => '',
                'gender' => '',
                'nationality1' => '',
                'nationality2' => '',
                'country_of_residence' => '',
            ],
            'title_id' => null,
        ];
    }

    static function newMovieCrew()
    {
        $crew[] = array_merge(Crew::defaultsCrew(), ['title_id' => Title::where('code', 'AUTHOR')->first()->id]);
        $crew[] = array_merge(Crew::defaultsCrew(), ['title_id' => Title::where('code', 'DIRECTOR')->first()->id]);
        $crew[] = array_merge(Crew::defaultsCrew(), ['title_id' => Title::where('code', 'COMPOSER')->first()->id]);
        $crew[] = array_merge(Crew::defaultsCrew(), ['title_id' => Title::where('code', 'PRODDESIGNER')->first()->id]);
        $crew[] = array_merge(Crew::defaultsCrew(), ['title_id' => Title::where('code', 'DIRPHOTOGRAPHY')->first()->id]);
        $crew[] = array_merge(Crew::defaultsCrew(), ['title_id' => Title::where('code', 'EDITOR')->first()->id]);
        $crew[] = array_merge(Crew::defaultsCrew(), ['title_id' => Title::where('code', 'SOUND')->first()->id]);
        $crew[] = array_merge(Crew::defaultsCrew(), ['title_id' => Title::where('code', 'ACTOR1')->first()->id]);
        $crew[] = array_merge(Crew::defaultsCrew(), ['title_id' => Title::where('code', 'ACTOR2')->first()->id]);
        $crew[] = array_merge(Crew::defaultsCrew(), ['title_id' => Title::where('code', 'ACTOR3')->first()->id]);
        return $crew;
    }

    static function requiredMovieCrew()
    {
        return [
            'AUTHOR',
            'DIRECTOR',
            'COMPOSER',
            'PRODDESIGNER',
            'DIRPHOTOGRAPHY',
            'EDITOR',
            'SOUND',
            'ACTOR1',
            'ACTOR2',
            'ACTOR3',
        ];
    }
}
