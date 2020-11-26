<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', // for PersonTable.php person editing
        'key', // for PersonTable.php person editing
        'title_id', // for PersonTable.php person editing
        'points',  // for PersonTable.php person editing
        'lastname',
        'firstname',
        'gender',
        'nationality1',
        'nationality2',
        'country_of_residence',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
    ];


    // Intermediate table
    public function crew()
    {
        return $this->hasOne(\App\Crew::class);
    }

    // Through intermediate table
    public function title()
    {
        return $this->hasOneThrough(\App\Title::class, \App\Crew::class, 'person_id', 'id', 'id', 'title_id');
    }

    // Through intermediate table
    public function media()
    {
        return $this->hasOneThrough(\App\Media::class, \App\Crew::class, 'person_id', 'id', 'id', 'media_id');
    }

    public function addPerson()
    {
        // create person
        // create crew
    }

    public function deletePerson()
    {
        // delete person
        // delete crew
    }

}
