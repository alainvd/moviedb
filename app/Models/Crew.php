<?php

namespace App\Models;

use App\Models\Movie;
use App\Models\Title;
use App\Models\Person;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Crew extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'movie_id',
        'person_id',
        'title_id',
        'points',
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
        return $this->belongsTo(Title::class);
    }

    public function person()
    {
        return $this->hasOne(Person::class, 'id', 'person_id');
    }

    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }

    static function defaultsCrew()
    {
        return [
            'person' => [
                'firstname' => '',
                'lastname' => '',
                'gender' => '',
                'nationality1' => '',
                'nationality2' => '',
                'country_of_residence' => '',
            ],
            'title_id' => null,
            'points' => null,
        ];
    }

    static function newMovieCrew($genre_id)
    {
        $crew = [];
        // Fiction
        if ($genre_id == 1) {
            $crew[] = array_merge(Crew::defaultsCrew(), ['title_id' => Title::where('code', 'DIRECTOR')->first()->id]);
            $crew[] = array_merge(Crew::defaultsCrew(), ['title_id' => Title::where('code', 'AUTHOR')->first()->id]);
            $crew[] = array_merge(Crew::defaultsCrew(), ['title_id' => Title::where('code', 'COMPOSER')->first()->id]);
            $crew[] = array_merge(Crew::defaultsCrew(), ['title_id' => Title::where('code', 'PRODDESIGNER')->first()->id]);
            $crew[] = array_merge(Crew::defaultsCrew(), ['title_id' => Title::where('code', 'DIRPHOTOGRAPHY')->first()->id]);
            $crew[] = array_merge(Crew::defaultsCrew(), ['title_id' => Title::where('code', 'EDITOR')->first()->id]);
            $crew[] = array_merge(Crew::defaultsCrew(), ['title_id' => Title::where('code', 'SOUND')->first()->id]);
            $crew[] = array_merge(Crew::defaultsCrew(), ['title_id' => Title::where('code', 'ACTOR1')->first()->id]);
            $crew[] = array_merge(Crew::defaultsCrew(), ['title_id' => Title::where('code', 'ACTOR2')->first()->id]);
            $crew[] = array_merge(Crew::defaultsCrew(), ['title_id' => Title::where('code', 'ACTOR3')->first()->id]);
        }
        // Creative Documentary
        if ($genre_id == 2) {
            $crew[] = array_merge(Crew::defaultsCrew(), ['title_id' => Title::where('code', 'DIRECTOR')->first()->id]);
            $crew[] = array_merge(Crew::defaultsCrew(), ['title_id' => Title::where('code', 'AUTHOR')->first()->id]);
            $crew[] = array_merge(Crew::defaultsCrew(), ['title_id' => Title::where('code', 'COMPOSER')->first()->id]);
            $crew[] = array_merge(Crew::defaultsCrew(), ['title_id' => Title::where('code', 'PRODDESIGNER')->first()->id]);
            $crew[] = array_merge(Crew::defaultsCrew(), ['title_id' => Title::where('code', 'DIRPHOTOGRAPHY')->first()->id]);
            $crew[] = array_merge(Crew::defaultsCrew(), ['title_id' => Title::where('code', 'EDITOR')->first()->id]);
            $crew[] = array_merge(Crew::defaultsCrew(), ['title_id' => Title::where('code', 'SOUND')->first()->id]);
        }
        // Animation
        if ($genre_id == 3) {
            $crew[] = array_merge(Crew::defaultsCrew(), ['title_id' => Title::where('code', 'DIRECTOR')->first()->id]);
            $crew[] = array_merge(Crew::defaultsCrew(), ['title_id' => Title::where('code', 'AUTHOR')->first()->id]);
            $crew[] = array_merge(Crew::defaultsCrew(), ['title_id' => Title::where('code', 'COMPOSER')->first()->id]);
            $crew[] = array_merge(Crew::defaultsCrew(), ['title_id' => Title::where('code', 'EDITOR')->first()->id]);
            $crew[] = array_merge(Crew::defaultsCrew(), ['title_id' => Title::where('code', 'SOUND')->first()->id]);
            $crew[] = array_merge(Crew::defaultsCrew(), ['title_id' => Title::where('code', 'STORYARTIST')->first()->id]);
            $crew[] = array_merge(Crew::defaultsCrew(), ['title_id' => Title::where('code', 'CHARDESIGNER')->first()->id]);
            $crew[] = array_merge(Crew::defaultsCrew(), ['title_id' => Title::where('code', 'ANIMATIONSUP')->first()->id]);
            $crew[] = array_merge(Crew::defaultsCrew(), ['title_id' => Title::where('code', 'ARTDIRECTOR')->first()->id]);
            $crew[] = array_merge(Crew::defaultsCrew(), ['title_id' => Title::where('code', 'TECHDIRECTOR')->first()->id]);
        }
        return $crew;
    }

    static function requiredMovieCrewTypes($genre_id)
    {
        if ($genre_id == 1) {
            return [
                'DIRECTOR',
                'AUTHOR',
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
        if ($genre_id == 2) {
            return [
                'DIRECTOR',
                'AUTHOR',
                'COMPOSER',
                'PRODDESIGNER',
                'DIRPHOTOGRAPHY',
                'EDITOR',
                'SOUND',
            ];
        }
        if ($genre_id == 3) {
            return [
                'DIRECTOR',
                'AUTHOR',
                'COMPOSER',
                'EDITOR',
                'SOUND',
                'STORYARTIST',
                'CHARDESIGNER',
                'ANIMATIONSUP',
                'ARTDIRECTOR',
                'TECHDIRECTOR',
            ];
        }
        return [];
    }
}
