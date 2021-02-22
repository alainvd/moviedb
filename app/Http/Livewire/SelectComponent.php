<?php

namespace App\Http\Livewire;

use Livewire\Component;

class SelectComponent extends Component
{

    public $ref;
    public $domId;
    public $label;
    public $isRequired;
    public $name;
    public $options;
    public $items;

    public function render()
    {
        return view('livewire.select-component');
    }
}
