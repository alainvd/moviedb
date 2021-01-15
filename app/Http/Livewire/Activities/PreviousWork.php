<?php

namespace App\Http\Livewire\Activities;

use Livewire\Component;

class PreviousWork extends Component
{
    public $activity;
    public $dossier;

    public function render()
    {
        return view('livewire.activities.previous-work');
    }
}
