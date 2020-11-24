<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Chip extends Component
{
    public $canRemove = false;

    public $label;

    public function remove()
    {
        $this->emitUp('chipRemoved', $this->label);
    }

    public function render()
    {
        return view('livewire.chip');
    }
}
