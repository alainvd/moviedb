<?php

namespace App\Http\Livewire\Dossiers\Activities;

class PreviousWork extends BaseActivity
{
    public function getUrlProperty()
    {
        $params = [
            'dossier' => $this->dossier,
            'activity' => $this->activity,
        ];
        $action = $this->dossier->action->name;
        if ( $action === 'DEVVG' ) {
            return  route('vg-prev-fiche-form', $params);
        }
        else {return  route('dev-prev-fiche-form', $params);}
        
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
