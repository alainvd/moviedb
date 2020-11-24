<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Log;
use Livewire\Component;

class Chip extends Component
{
    public $canRemove = false;

    public $label;

    public function remove()
    {
        Log::info($this->label);
        $this->emitUp('chipRemoved', $this->label);
    }

    public function render()
    {
        return view('livewire.chip');
    }
}
