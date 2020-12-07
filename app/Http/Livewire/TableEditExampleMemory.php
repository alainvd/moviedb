<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Producer;
use App\Models\Country;
use Illuminate\Support\Str;

class TableEditExampleMemory extends Component
{

    public $media_id = null;

    public $items = [];

    public $showingEditModal = false;

    public $showingDeleteModal = false;

    public $deleteItemKey = null;

    public Producer $editing;

    public $countries = [];

    public $producer_roles = [];

    private function defaults()
    {
        return [
            'role' => 'producer',
            'country_id' => Country::first()->id,
        ] + ['key' => Str::random(10)];
    }

    protected $rules = [
        'editing.id' => '',
        'editing.media_id' => '',
        'editing.role' => 'required',
        'editing.name' => 'required|string|max:255',
        'editing.city' => 'required|string|max:255',
        'editing.country_id' => 'required',
        'editing.share' => 'required|integer',
        'editing.budget' => 'required|integer',
    ]
    + ['editing.key' => ''];

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

    private function findItemByKey($key)
    {
        $item = array_filter(
            $this->items,
            function($a) use ($key) {
                if ($a['key'] == $key) return $a;
            }
        );
        return $item;
    }

    private function getItemByKey($key)
    {
        $item = $this->findItemByKey($key);
        return array_shift($item);
    }

    private function load()
    {
        $this->items = Producer::where('media_id', $this->media_id)->get()->toArray();
        // Add unique keys
        $this->items = array_map(
            function ($a) {
                $a['key'] = Str::random(10);
                return $a;
            },
            $this->items
        );
    }

    public function mount($media_id = null)
    {
        $this->countries = Country::all()->toArray();
        $this->producer_roles = Producer::ROLES;
        if ($media_id) {
            $this->media_id = $media_id;
            $this->load();
        }
    }

    public function render()
    {
        return view('livewire.table-edit-example-memory');
    }

    public function showModalEdit($key = null)
    {
        if ($key) {
            $this->editing = new Producer($this->getItemByKey($key));
        } else {
            $this->editing = new Producer($this->defaults());
        }
        $this->showingEditModal = true;
    }

    public function showModalAdd()
    {
        $this->editing = new Producer($this->defaults());
        $this->resetValidation();
        $this->showingEditModal = true;
    }

    public function saveItem()
    {
        $this->validate();
        $this->showingEditModal = false;
        $editing = $this->editing->toArray();
        $findItem = $this->findItemByKey($editing['key']);
        if (!empty($findItem)) {
            $itemKey = array_key_first($findItem);
            $this->items[$itemKey] = $editing;
        } else {
            $this->items[] = $editing;
        }

        $this->sendItems();
    }

    public function showModalDelete($key)
    {
        $this->showingDeleteModal = true;
        $this->deleteItemKey = $key;
    }

    public function deleteItem()
    {
        $this->showingDeleteModal = false;
        $findItem = $this->findItemByKey($this->deleteItemKey);
        if (!empty($findItem)) {
            $itemKey = array_key_first($findItem);
            unset($this->items[$itemKey]);
        }

        $this->sendItems();
    }

    private function sendItems()
    {
        $this->emitUp('update-producers', $this->items);
    }

}
