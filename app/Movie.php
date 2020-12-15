<?php

namespace App;

use App\Events\MovieCreated;
use App\Interfaces\Grantable;
use App\Models\Language;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model implements Grantable
{
    use HasFactory;

    //Event to create a media when we create a movie
    protected $dispatchesEvents = [
        'created' => MovieCreated::class,
    ];

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
    ];

    public function media()
    {
        return $this->morphOne(\App\Media::class, 'grantable');
    }

    public function crews()
    {
        return $this->hasMany(\App\Crew::class, 'media_id', 'id');
    }

    public function whoami()
    {
        return "I'm a movie ... bring some popcorn";
    }

    public function audience()
    {
        return $this->media()->audience();
    }

    public function languages()
    {
        return $this->belongsToMany(Language::class, 'movie_language');
    }

    public function addPerson($person, $points, $title_id, $media_id, $movie_id)
    {
        $person = \App\Person::create($person);
        $media_id = Movie::find($movie_id)->media->id;
        $crew = Crew::create([
            'points' => $points,
            'person_id' => $person->id,
            'title_id' => $title_id,
            'media_id' => $media_id
        ]);
        return $person;
    }
}
