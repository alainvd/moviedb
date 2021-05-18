<?php

namespace App\Http\Livewire;

class TableEditMovieLocationsDevCurrent extends TableEditMovieLocations
{

    protected function rules() {
        return [
            'editing.type' => 'required|string',
            'editing.name' => 'required|string',
            'editing.country' => 'required|string',
            'editing.points' => '',
        ] + TableEditBase::rules();
    }

    public function tableEditRules($isEditor)  {
        $rules = $this->rules() + TableEditBase::rules();
        return parent::rulesCleanup($rules);
    }

    public function render()
    {
        return view('livewire.table-edit-movie-locations', ['fiche' => 'devCurrent', 'rules' => $this->rules()]);
    }

}
