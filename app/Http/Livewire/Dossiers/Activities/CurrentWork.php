<?php

namespace App\Http\Livewire\Dossiers\Activities;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class CurrentWork extends BaseActivity
{
    public function getUrlProperty()
    {
        $params = [
            'dossier' => $this->dossier,
            'activity' => $this->activity,
        ];

        return $this->dossier->action->name === 'TVONLINE'
            ? route('tv-fiche-form', $params)
            : route('dev-current-fiche-form', $params);
    }

    public function render()
    {
        $results = $this->dossier->fiches()->forActivity($this->activity->id)->get();
        $print = $this->print;
        $isEditor = Auth::user()->hasRole('editor');
        return view(
            'livewire.dossiers.activities.current-work',
            compact('results', 'print', 'isEditor')
        );
    }
}
