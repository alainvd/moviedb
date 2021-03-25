<?php

namespace App\Http\Livewire\Dossiers\Activities;

use Livewire\Component;

class PreviousWork extends BaseActivity
{
    public function mount()
    {
        $this->logModel = 'Previous Work';
        parent::mount();
    }

    public function render()
    {
        $results = $this->dossier->fiches()->forActivity($this->activity->id)->get();
        $print = $this->print;
        return view(
            'livewire.dossiers.activities.previous-work',
            compact('results', 'print')
        );
    }
}
