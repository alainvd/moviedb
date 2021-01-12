<?php

namespace App\Http\Livewire;

use App\Movie;
use App\Title;
use App\Crew;
use App\Person;
use App\Models\Country;

class TableEditMovieCrewsDevCurrent extends TableEditMovieCrews
{

    static function rules()
    {
        return [
            'editing.points' => 'numeric',
            'editing.title_id' => 'required',
            'editing.person.firstname' => 'required|string|max:255',
            'editing.person.lastname' => 'required|string|max:255',
            'editing.person.gender' => 'required|string|max:255',
            'editing.person.nationality1' => 'required|string|max:255',
            'editing.person.nationality2' => 'string|max:255',
            'editing.person.country_of_residence' => 'string|max:255',
        ] + TableEditBase::rules();
    }

    public function render()
    {
        return view('livewire.table-edit-movie-crews', ['fiche' => 'devCurrent']);
    }

}
