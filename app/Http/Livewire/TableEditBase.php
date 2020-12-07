<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Producer;
use App\Models\Country;
use Illuminate\Support\Str;

class TableEditBase extends Component
{

    public $items = [];

    public $showingEditModal = false;

    public $showingDeleteModal = false;

    public $deleteItemKey = null;

    // public Producer $editing;

    private function defaults()
    {
        return ['key' => Str::random(10)];
    }

    protected $rules = [
        'editing.id' => '',
        'editing.key' => ''
    ];

    protected $validationAttributes = [
        'editing.id' => 'id',
    ];

    protected function findItemByKey($key)
    {
        $item = array_filter(
            $this->items,
            function($a) use ($key) {
                if ($a['key'] == $key) return $a;
            }
        );
        return $item;
    }

    protected function getItemByKey($key)
    {
        $item = $this->findItemByKey($key);
        return array_shift($item);
    }

    protected function addUniqueKeys()
    {
        $this->items = array_map(
            function ($a) {
                $a['key'] = Str::random(10);
                return $a;
            },
            $this->items
        );
    }

    public function render()
    {
        return view('livewire.table-edit-example-memory');
    }

    // public function showModalEdit($key = null)
    // {
    //     if ($key) {
    //         $this->editing = new Producer($this->getItemByKey($key));
    //     } else {
    //         $this->editing = new Producer($this->defaults());
    //     }
    //     $this->showingEditModal = true;
    // }

    // public function showModalAdd()
    // {
    //     $this->editing = new Producer($this->defaults());
    //     $this->resetValidation();
    //     $this->showingEditModal = true;
    // }

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

    protected function sendItems()
    {
        $this->emitUp('update-items', $this->items);
    }

}
