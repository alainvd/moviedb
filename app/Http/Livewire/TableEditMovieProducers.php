<?php

namespace App\Http\Livewire;

use App\Models\Movie;
use App\Models\Producer;

class TableEditMovieProducers extends TableEditBase
{

    public Movie $movie;

    public $budget_total = 0;

    protected function defaults()
    {
        return Producer::defaultsProducer() + parent::defaults();
    }

    protected function rules()
    {
        return [
            'editing.role' => 'required|string',
            'editing.name' => 'required|string|max:255',
            'editing.city' => 'required|string|max:255',
            'editing.country' => 'required|string',
            'editing.language' => 'string',
            'editing.share' => 'required|numeric|min:0|max:100',
            'editing.budget' => '',
        ] + TableEditBase::rules();
    }

    public function tableEditRules($isEditor)  {
        $rules = $this->rules() + TableEditBase::rules();
        return parent::rulesCleanup($rules);
    }

    protected function validationAttributes()
    {
        return [
            'editing.movie_id' => 'movie_id',
            'editing.role' => 'role',
            'editing.name' => 'company name',
            'editing.city' => 'city',
            'editing.country' => 'country',
            'editing.language' => 'language',
            'editing.share' => 'share',
            'editing.budget' => 'budget',
        ];
    }

    private function loadItems()
    {
        $this->items = Producer::where('movie_id', $this->movie->id)->get()->toArray();
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
        return view('livewire.table-edit-movie-producers', ['fiche' => 'dist', 'rules' => $this->rules()]);
    }

    protected function sendItems()
    {
        $this->emitUp('updateMovieProducers', $this->items);
    }
    
}
