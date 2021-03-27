<?php

namespace App\Http\Livewire;

class TableEditMovieProducersTv extends TableEditMovieProducers
{

    protected function rules()
    {
        return [
            'editing.role' => 'required|string',
            'editing.name' => 'required|string|max:255',
            'editing.country' => 'required|string',
            'editing.language' => 'string',
        ] + TableEditBase::rules();
    }

    public function tableEditRules($isEditor)  {
        $rules = $this->rules() + TableEditBase::rules();
        return parent::rulesCleanup($rules);
    }
    
    public function render()
    {
        return view('livewire.table-edit-movie-producers', ['fiche' => 'tv', 'rules' => $this->rules()]);
    }
    
}
