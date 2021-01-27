<?php

namespace App\Http\Livewire;

use App\Genre;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class SelectComponent extends Component
{

    public $domId;
    public $label;
    public $name;
    public $options;
    public $items;

    public function render()
    {
        return view('livewire.select-component');
    }
}
