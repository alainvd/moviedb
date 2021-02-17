<?php

namespace App\Http\Livewire\Dossiers\Activities;

use Livewire\Component;

class CurrentWork extends Component
{
    public $activity;
    public $dossier;

    public $deletingId = null;
    public $showDeleteModal = false;

    public function deleteCurrentWork()
    {
        if ($this->deletingId) {
            $this->dossier->fiches()->detach($this->deletingId);
            $this->deletingId = null;
            $this->showDeleteModal = false;
        }
    }

    public function showDelete($id)
    {
        $this->deletingId = $id;
        $this->showDeleteModal = true;
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
