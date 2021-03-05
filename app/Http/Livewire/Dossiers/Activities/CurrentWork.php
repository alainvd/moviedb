<?php

namespace App\Http\Livewire\Dossiers\Activities;

use Livewire\Component;

class CurrentWork extends BaseActivity
{
    public function getUrlProperty()
    {
        $params = [
            'dossier' => $this->dossier,
            'activity' => $this->activity,
        ];

        return $this->dossier->action->name === 'TV'
            ? route('tv-fiche-form', $params)
            : route('dev-current-fiche-form', $params);
    }

    public function render()
    {
        $results = $this->dossier->fiches()->forActivity($this->activity->id)->get();
        return view(
            'livewire.dossiers.activities.current-work',
            compact('results')
        );
    }
}
