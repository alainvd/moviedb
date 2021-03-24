<?php

namespace App\Http\Livewire\Dossiers;

use App\Http\Controllers\HistoryController;
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

    public function render()
    {
        return view('livewire.dossiers.advanced-history', [
            'logs' => HistoryController::getFormattedLogs($this->model)
        ]);
    }
}
