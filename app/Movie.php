<?php

namespace App;

use App\Interfaces\Grantable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model implements Grantable
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
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

    public function addPerson($person, $points, $title_id, $movie_id)
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
