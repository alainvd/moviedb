<?php

namespace App\Http\Livewire\Dossiers\Activities;

use Livewire\Component;
use Illuminate\Support\Str;

class BaseActivity extends Component
{

    public $activity;
    public $dossier;

    public $deletingId = null;
    public $showDeleteModal = false;

    public $current = 0;
    public $max = 0;
    public $isAddDisabled = false;

    public function mount()
    {
        $this->current = $this->dossier->fiches()->forActivity($this->activity->id)->count();
        $rules = $this->activity->pivot->rules;
        $activity = Str::of($this->activity->name)->camel()->snake();

        // Add button disabled prop by checking for max number of works
        // and comparing to current number of works
        if (array_key_exists("max_{$activity}s", $rules)) {
            $this->max = $rules["max_{$activity}s"];
            if ($this->current === $this->max) {
                $this->isAddDisabled = true;
            }
        }
    }

    public function delete()
    {
        if ($this->deletingId) {
            // @todo implement remove in child component
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
}
