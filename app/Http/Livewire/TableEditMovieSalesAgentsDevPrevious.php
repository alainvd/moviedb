<?php

namespace App\Http\Livewire;

class TableEditMovieSalesAgentsDevPrevious extends TableEditMovieSalesAgents
{

    static function rules()
    {
        return [
            'editing.name' => 'required|string|max:255',
            'editing.country_id' => 'required',
            'editing.contact_person' => '',
            'editing.email' => '',
            'editing.distribution_date' => 'required|date:d.m.Y',
        ] + TableEditBase::rules();
    }

    public function render()
    {
        return view('livewire.table-edit-movie-sales-agents', ['fiche' => 'devPrev']);
    }
    
}
