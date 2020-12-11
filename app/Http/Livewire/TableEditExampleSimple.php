<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Producer;
use App\Models\Country;

class TableEditExampleSimple extends Component
{

    public $media_id = null;

    public $producers = [];

    public $showingEditModal = false;

    public $showingDeleteModal = false;

    public $deleteItemId = null;

    public Producer $editing;

    public $countries = [];

    public $producer_roles = [];

    private function defaults()
    {
        return [
            'role' => 'producer',
            'country_id' => Country::first()->id,
        ];
    }

    protected $rules = [
        'editing.id' => '',
        'editing.media_id' => 'required',
        'editing.role' => 'required',
        'editing.name' => 'required|string|max:255',
        'editing.city' => 'required|string|max:255',
        'editing.country_id' => 'required',
        'editing.share' => 'required|integer',
        'editing.budget' => 'required|integer',
    ];

    protected $validationAttributes = [
        'editing.id' => 'id',
        'editing.media_id' => 'media_id',
        'editing.role' => 'role',
        'editing.name' => 'name',
        'editing.city' => 'city',
        'editing.country_id' => 'country',
        'editing.share' => 'share',
        'editing.budget' => 'budget',
    ];

    private function reload()
    {
        $this->producers = Producer::where('media_id', $this->media_id)->get()->toArray();
    }

    public function mount($media_id = null)
    {
        $this->countries = Country::all()->toArray();
        $this->producer_roles = Producer::ROLES;
        if ($media_id) {
            $this->media_id = $media_id;
            $this->reload();
        }
    }

    public function render()
    {
        return view('livewire.table-edit-example-simple');
    }

    public function showModalEdit($id)
    {
        $this->editing = Producer::where('id', $id)->first();
        $this->showingEditModal = true;
    }

    public function showModalAdd()
    {
        $this->editing = new Producer(['media_id' => $this->media_id] + $this->defaults());
        $this->resetValidation();
        $this->showingEditModal = true;
    }

    public function saveItem()
    {
        $this->validate();
        $this->showingEditModal = false;
        $this->editing->save();

        $this->reload();
    }

    public function showModalDelete($id) {
        $this->showingDeleteModal = true;
        $this->deleteItemId = $id;
    }

    public function deleteItem()
    {
        $this->showingDeleteModal = false;
        Producer::where('id', $this->deleteItemId)->delete();

        $this->reload();
    }

}
