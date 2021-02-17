<?php

namespace App\Http\Livewire\Dossiers\Activities;

use Livewire\Component;

class PreviousWork extends Component
{
    public $activity;
    public $dossier;

    public $deletingId = null;
    public $showDeleteModal = false;

    public function showDelete($id)
    {
        $this->showDeleteModal = true;
        $this->deletingId = $id;
    }

    public function deletePreviousWork()
    {
        if ($this->deletingId) {
            $this->dossier->fiches()->detach($this->deletingId);
            $this->deletingId = null;
            $this->showDeleteModal = false;
        }
    }

    public function render()
    {
        $results = $this->dossier->fiches()->forActivity($this->activity->id)->get();
        return view(
            'livewire.dossiers.activities.previous-work',
            compact('results')
        );
    }
}
