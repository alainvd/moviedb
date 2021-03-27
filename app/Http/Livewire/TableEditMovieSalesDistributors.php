<?php

namespace App\Http\Livewire;

use App\Models\Movie;
use App\Models\SalesDistributor;

class TableEditMovieSalesDistributors extends TableEditBase
{

    public Movie $movie;

    protected function defaults()
    {
        return SalesDistributor::defaultsSalesDistributor() + parent::defaults();
    }

    protected function rules()
    {
        return [
            'editing.name' => 'required|string|max:255',
            'editing.role' => 'required|string',
            'editing.countries' => 'required',
            'editing.release_date' => 'required|date:d.m.Y',
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
            'editing.role' => 'role',
            'editing.countries' => 'countries',
            'editing.release_date' => 'release date',
        ];
    }

    private function loadItems()
    {
        $this->items = SalesDistributor::with('countries')->where('movie_id', $this->movie->id)->get()->toArray();
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
        return view('livewire.table-edit-movie-sales-distributors', ['fiche' => 'dev-prev', 'rules' => $this->rules()]);
    }

    protected function sendItems()
    {
        $this->emitUp('updateMovieSalesDistributors', $this->items);
    }

    public function showModalEdit($key = null)
    {
        parent::showModalEdit($key);

        // Reinit Choices widget with different country values
        $editing_countries_ids = collect($this->editing['countries'])->pluck('id')->toArray();
        $countries_values = collect($this->countries_value_label)->filter(
            function ($c) use ($editing_countries_ids) {
                return in_array($c['value'], $editing_countries_ids);
            }
        )->values();
        $this->emit('showModalInit', $countries_values);
    }

    public function showModalAdd()
    {
        parent::showModalAdd();
        $this->emit('showModalInit', []);
    }

    public function addCountry($id) {
        $current_countries = collect($this->editing['countries'])->pluck('id')->toArray();
        if (!in_array($id, $current_countries)) {
            $this->editing['countries'][] = ['id' => $id];
        }
    }

    public function removeCountry($id) {
        $this->editing['countries'] = array_filter(
            $this->editing['countries'],
            function ($c) use ($id) {return $c['id'] !== $id;}
        );
    }
    
}
