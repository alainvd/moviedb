<?php

namespace App\Http\Livewire;

use App\Models\Movie;
use App\Models\Producer;

class TableEditExampleMemory extends TableEditBase
{

    public Movie $movie;

    public $movie_id = null;

    protected function defaults()
    {
        return [
            'role' => '',
            'name' => '',
            'city' => '',
            'country' => '',
            'share' => null,
            'budget' => null,
        ] + parent::defaults();
    }

    protected function rules()
    {
        return [
            'editing.role' => 'required|string',
            'editing.name' => 'required|string|max:255',
            'editing.city' => 'required|string|max:255',
            'editing.country' => 'required|string',
            'editing.share' => 'required|integer|min:1|max:100',
            'editing.budget' => '',
        ] + TableEditBase::rules();
    }

    protected function validationAttributes()
    {
        return [
            'editing.movie_id' => 'movie_id',
            'editing.role' => 'role',
            'editing.name' => 'name',
            'editing.city' => 'city',
            'editing.country' => 'country',
            'editing.share' => 'share',
            'editing.budget' => 'budget',
        ];
    }

    private function loadItems()
    {
        $this->items = Producer::where('movie_id', $this->movie_id)->get()->toArray();
        $this->addUniqueKeys();
    }

    public function mount($movie_id = null, $isApplicant = false, $isEditor = false)
    {
        parent::mount($movie_id, $isApplicant, $isEditor);
        $this->movie = new Movie();
        if ($movie_id) {
            $this->movie_id = $movie_id;
            $this->loadItems();
        }
    }

    public function render()
    {
        return view('livewire.table-edit-example-memory', ['rules' => $this->rules()]);
    }

    protected function sendItems()
    {
        dd('sendItems: manage saving in the parent component');
        $this->emitUp('update-producers', $this->items);
    }

}
