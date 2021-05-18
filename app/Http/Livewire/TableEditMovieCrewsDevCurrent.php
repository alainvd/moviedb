<?php

namespace App\Http\Livewire;

class TableEditMovieCrewsDevCurrent extends TableEditMovieCrews
{

    protected $rules = [
        'editing.points' => '',
        'editing.person.firstname' => 'required|string|max:255',
        'editing.person.lastname' => 'required|string|max:255',
        'editing.person.gender' => 'required|string',
        'editing.person.nationality1' => 'required|string',
        'editing.person.nationality2' => 'string',
        'editing.person.country_of_residence' => 'string',
        'editing.title_id' => 'required|integer',
    ];

    protected function rules() {
        return $this->rules + TableEditBase::rules();
    }

    public function tableEditRules($isEditor = null) {
        $rules = $this->rules + TableEditBase::rules();
        return parent::rulesCleanup($rules);
    }

    public function render()
    {
        return view('livewire.table-edit-movie-crews', ['fiche' => 'devCurrent', 'rules' => $this->rules()]);
    }

}
