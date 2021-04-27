<?php

namespace App\Http\Livewire;

use App\Models\Movie;
use App\Models\SalesAgent;

class TableEditMovieSalesAgents extends TableEditBase
{

    public Movie $movie;

    protected function defaults()
    {
        return SalesAgent::defaultsSalesAgent() + parent::defaults();
    }

    protected function rules()
    {
        return [
            'editing.name' => 'required|string|max:255',
            'editing.country' => 'required|string',
            'editing.contact_person' => 'required|string|max:255',
            'editing.email' => 'required|string|max:255',
            'editing.distribution_date' => '',
        ] + TableEditBase::rules();
    }

    public function tableEditRules($isEditor)  {
        $rules = $this->rules() + TableEditBase::rules();
        return parent::rulesCleanup($rules);
    }
    
    protected function validationAttributes()
    {
        return [
            'editing.name' => 'company name',
            'editing.country' => 'country',
            'editing.contact_person' => 'contact person',
            'editing.email' => 'email',
            'editing.distribution_date' => 'date',
        ];
    }

    private function loadItems()
    {
        $this->items = SalesAgent::where('movie_id', $this->movie->id)->get()->toArray();
        $this->addUniqueKeys();
    }

    public function mount($movie_id = null, $isApplicant = false, $isEditor = false)
    {
        parent::mount($movie_id, $isApplicant, $isEditor);
        $this->movie = new Movie();
        if ($movie_id) {
            $this->movie = Movie::find($movie_id);
            $this->loadItems();
        }
    }

    public function render()
    {
        return view('livewire.table-edit-movie-sales-agents', ['fiche' => 'dist', 'rules' => $this->rules()]);
    }

    protected function sendItems()
    {
        $this->emitUp('updateMovieSalesAgents', $this->items);
    }

}
