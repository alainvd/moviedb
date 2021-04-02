<?php

namespace App\Http\Livewire;

use App\Models\Movie;
use App\Models\Producer;

class TableEditExampleSimple extends TableEditBase
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
            'editing.share' => 'required|numeric|min:1|max:100',
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

    public function saveItem()
    {
        $this->validate();
        $this->showingEditModal = false;
        if (isset($this->editing['id'])) {
            $producer = Producer::find($this->editing['id']);
        } else {
            $producer = new Producer;
        }
        $producer->fill($this->editing);
        $producer->movie_id = $this->movie_id;
        $producer->save();
        $this->load();
    }

    public function deleteItem()
    {
        $this->showingDeleteModal = false;
        $item = $this->getItemByKey($this->deleteItemKey);
        Producer::where('id', $item['id'])->delete();
        $this->load();
    }

    public function render()
    {
        return view('livewire.table-edit-example-simple', ['rules' => $this->rules()]);
    }

}
