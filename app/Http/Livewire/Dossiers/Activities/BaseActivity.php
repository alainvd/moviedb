<?php

namespace App\Http\Livewire\Dossiers\Activities;

use App\Models\Fiche;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Str;

class BaseActivity extends Component
{

    public $activity;
    public $dossier;
    public $print = false;

    public $deletingId = null;
    public $showDeleteModal = false;

    public $current = 0;
    public $max = 0;
    public $isAddDisabled = false;

    protected $logModel = '';

    public function mount()
    {
        $this->current = $this->dossier->fiches()->forActivity($this->activity->id)->count();
        $rules = $this->activity->pivot->rules;
        $activity = Str::of($this->activity->name)->camel()->snake()->plural();

        // Add button disabled prop by checking for max number of works
        // and comparing to current number of works
        if (array_key_exists("max_{$activity}", $rules)) {
            $this->max = $rules["max_{$activity}"];
            $this->isAddDisabled = $this->current === $this->max;
        }
    }

    public function delete()
    {
        if ($this->deletingId) {
            $this->dossier->fiches()->detach($this->deletingId);
            $model = Str::of(class_basename($this))
                ->singular()
                ->replaceMatches("/(?<=\\w)(?=[A-Z])/", " $1")
                ->lower()
                ->ucfirst();
            // Add activity log
            activity()
                ->on($this->dossier)
                ->by(Auth::user())
                ->withProperties([
                    'model' => $model,
                    'operation' => 'removed',
                    'movie' => Fiche::find($this->deletingId)->movie->toArray()
                ])->log('removed');
            $this->deletingId = null;
            $this->showDeleteModal = false;
            $this->current--;
            $this->isAddDisabled = $this->max ? $this->current === $this->max : false;
        }
    }

    public function showDelete($id)
    {
        $this->deletingId = $id;
        $this->showDeleteModal = true;
    }
}
