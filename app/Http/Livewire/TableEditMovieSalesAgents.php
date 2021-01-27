<?php

namespace App\Http\Livewire;

use App\Movie;
use App\SalesAgent;
use App\Models\Country;

class TableEditMovieSalesAgents extends TableEditBase
{

    public Movie $movie;

    public $countries = [];

    public $countries_by_code = [];

    protected function defaults()
    {
        return [
            'name' => '',
            'country' => '',
            'contact_person' => '',
            'email' => '',
            'distribution_date' => null,
        ] + parent::defaults();
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

    protected function validationAttributes()
    {
        return [
            'editing.name' => 'name',
            'editing.country' => 'country',
            'editing.contact_person' => 'contact person',
            'editing.email' => 'email',
            'editing.distribution_date' => 'date',
        ];
    }

    private function load()
    {
        $this->items = SalesAgent::where('media_id', $this->movie->media->id)->get()->toArray();
        $this->addUniqueKeys();
    }

    public function mount($movie_id = null)
    {
        $this->countries = Country::where('active', true)->orderBy('name')->get()->toArray();
        $this->countries_by_code = Country::where('active', true)->orderBy('name')->get()->keyBy('code')->toArray();
        if ($movie_id) {
            $this->movie = Movie::find($movie_id);
            $this->load();
        }
    }

    public function render()
    {
        return view('livewire.table-edit-movie-sales-agents', ['fiche' => 'dist']);
    }

    protected function sendItems()
    {
        $this->emitUp('update-movie-sales-agents', $this->items);
    }
}
