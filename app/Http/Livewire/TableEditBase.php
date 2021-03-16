<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class TableEditBase extends Component
{

    public $items = [];

    public $showingEditModal = false;

    public $showingDeleteModal = false;

    public $deleteItemKey = null;

    public $editing;

    public $isApplicant = false;

    public $isEditor = false;

    public $print = false;

    /**
     * Livewire works better if form fields have a value set.
     * Create default values for all fields:
     *  - For string fields - empty string.
     *  - For numberic/integer fields - null.
     *  - For date fields - null.
     * Key field is a unique key to identify item in the table.
     */
    protected function defaults()
    {
        return [
            'key' => Str::random(10),
            'required' => false,
        ];
    }

    /**
     * Give validation rules for all fields.
     * Can create rules for applicant or editor.
     * If field is not used on the particular form:
     *  - Numberic field validation set to ''
     *  - String field validation set to '' or 'string'
     *  - Date field validation set to ''
     */
    protected function rules()
    {
        return [
            'editing.id' => '',
            'editing.key' => ''
        ];
    }

    public function rulesCleanup($rules = []) {
        $rules_new = [];
        foreach ($rules as $name => $val) {
            // remove "editing." part
            $rules_new[substr($name, 8)] = $val;
        }
        return $rules_new;
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
        // try{
        //     $validatedData = $this->validate();
        // }
        // catch (ValidationException $e){
        //     dd($e->validator->getMessageBag());
        // }
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
        // Implement this in each subclass
        // $this->emitUp('updateItemTypeItems', $this->items);
    }

}
