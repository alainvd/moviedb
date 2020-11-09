<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ShowClosedCalls extends Component
{

    public $show = false;

    public function updated() {
        if ($this->show) {
            $this->emit('showClosedCalls');
        } else {
            $this->emit('hideClosedCalls');
        }
    }

    public function render()
    {
        return view('livewire.show-closed-calls', [
            'show' => $this->show,
        ]);
    }
}
