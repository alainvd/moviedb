<?php

namespace App\Http\Livewire\Dossiers\Activities;

use Livewire\Component;

class PreviousWork extends Component
{
    public $activity;
    public $dossier;

    public function render()
    {
        return view('livewire.dossiers.activities.previous-work');
    }
}
