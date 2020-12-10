<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Str;

class TableEditBase extends Component
{

    public $items = [];

    public $showingEditModal = false;

    public $showingDeleteModal = false;

    public $deleteItemKey = null;

    public $editing;

    protected function defaults()
    {
        return ['key' => Str::random(10)];
    }

    protected function rules()
    {
        return [
            'editing.id' => '',
            'editing.key' => ''
        ];
    }

    protected function validationAttributes()
    {
        return [
        'editing.id' => 'id',
        ];
    }

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

    public function showModalEdit($key = null)
    {
        if ($key) {
            $this->editing = $this->getItemByKey($key);
        } else {
            $this->editing = $this->defaults();
        }
        $this->showingEditModal = true;
        $this->resetValidation();
    }

    public function showModalAdd()
    {
        $this->editing = $this->defaults();
        $this->resetValidation();
        $this->showingEditModal = true;
    }

    public function saveItem()
    {
        $this->validate();
        $this->showingEditModal = false;
        $editing = $this->editing;
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
