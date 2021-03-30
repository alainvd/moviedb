<?php

namespace App\Http\Livewire\Dossiers;

use App\Http\Controllers\HistoryController;
use App\Models\Audience;
use App\Models\Genre;
use App\Models\Status;
use Livewire\Component;
use Spatie\Activitylog\Models\Activity as ActivityLog;

class AdvancedHistory extends Component
{
    public $model;
    public $changes = [];
    public $showViewChanges = false;

    protected $listeners = [
        'refresh' => '$refresh'
    ];

    public function toggleView(ActivityLog $log)
    {
        $this->changes = $log->properties;
        $this->showViewChanges = true;
    }

    public function updatedShowViewChanges()
    {
        if (!$this->showViewChanges) {
            $this->reset('changes');
        }
    }

    public function getLabel($key)
    {
        switch ($key) {
            case 'genre_id':
                return 'genre';
            case 'audience_id':
                return 'audience';
            case 'status_id':
                return 'status';
            default:
                // Remove movie.* prefix (if the case) and replace underscore
                $parts = explode('.', $key);
                return str_replace('_', ' ', count($parts) > 1 ? $parts[1] : $parts[0]);
        }
    }

    public function getValue($key, $value)
    {
        switch ($key) {
            case 'status_id':
                return Status::find($value)->name;
            case 'genre_id':
                return Genre::find($value)->name;
            case 'audience_id':
                return Audience::find($value)->name;
            default:
                return $value;
        }
    }

    public function render()
    {
        return view('livewire.dossiers.advanced-history', [
            'logs' => HistoryController::getFormattedLogs($this->model)
        ]);
    }
}
