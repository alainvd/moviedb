<?php

namespace App\Http\Livewire;

class TableEditMovieSalesAgentsDevPrevious extends TableEditMovieSalesAgents
{

    protected function rules()
    {
        return [
            'editing.name' => 'required|string|max:255',
            'editing.role' => 'required|string',
            'editing.country' => 'required|string',
            'editing.contact_person' => 'string',
            'editing.email' => 'string',
            'editing.distribution_date' => 'required|date:d.m.Y',
        ] + TableEditBase::rules();
    }

    public function tableEditRules($isEditor)  {
        $rules = $this->rules() + TableEditBase::rules();
        return parent::rulesCleanup($rules);
    }
    
    public function render()
    {
        return view('livewire.table-edit-movie-sales-agents', ['fiche' => 'devPrev', 'rules' => $this->rules()]);
    }

}
