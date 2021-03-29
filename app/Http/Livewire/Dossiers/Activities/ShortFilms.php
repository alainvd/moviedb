<?php

namespace App\Http\Livewire\Dossiers\Activities;

use Livewire\Component;

class ShortFilms extends BaseActivity
{
    public function render()
    {
        $results = $this->dossier->fiches()->forActivity($this->activity->id)->get();
        return view('livewire.dossiers.activities.short-films', compact('results'));
    }
}
