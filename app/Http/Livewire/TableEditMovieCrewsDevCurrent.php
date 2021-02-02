<?php

namespace App\Http\Livewire;

use App\Models\Movie;
use App\Models\Title;
use App\Models\Crew;
use App\Models\Person;
use App\Models\Country;

class TableEditMovieCrewsDevCurrent extends TableEditMovieCrews
{

    protected function rules()
    {
        return [
            'editing.points' => '',
            'editing.person.firstname' => 'required|string|max:255',
            'editing.person.lastname' => 'required|string|max:255',
            'editing.person.gender' => 'required|string',
            'editing.person.nationality1' => 'required|string',
            'editing.person.nationality2' => 'string',
            'editing.person.country_of_residence' => 'string',
            'editing.title_id' => 'required|integer',
        ] + TableEditBase::rules();
    }

    public function render()
    {
        return view('livewire.table-edit-movie-crews', ['fiche' => 'devCurrent']);
    }

}
