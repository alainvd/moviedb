<?php

namespace App\Http\Livewire;

use App\Exports\DossiersExport;
use App\Exports\DossiersWithDistribution;
use App\Exports\FichesWithCrews;
use App\Models\Action;
use App\Models\Call;
use App\Models\Status;
use Livewire\Component;

class Export extends Component
{
    public $from;
    public $to;
    public $year;
    public $exportFiches = false;

    public $selectedActions;
    public $selectedCalls;
    public $selectedStatuses;

    public function mount()
    {
        $this->selectedActions = collect([]);
        $this->selectedCalls = collect([]);
        $this->selectedStatuses = collect([]);
    }

    protected function getListeners()
    {
        return [
            'addItem',
            'removeItem'
        ];
    }

    public function buildParams()
    {
        $params = [];

        if ($this->selectedActions->count()) {
            $params['actions'] = $this->selectedActions->map(fn ($action) => $action['value']);
        }

        if ($this->selectedCalls->count()) {
            $params['calls'] = $this->selectedCalls->map(fn ($call) => $call['value']);
        }

        if ($this->selectedStatuses->count()) {
            $params['statuses'] = $this->selectedStatuses->map(fn($status) => $status['value']);
        }

        if ($this->year) {
            $params['year'] = $this->year;
        }

        if ($this->from) {
            $params['from'] = $this->from;
        }

        if ($this->to) {
            $params['to'] = $this->to;
        }

        return collect($params);
    }

    public function addItem($selected)
    {
        $this->{$selected[0]}->push($selected[1]);
    }

    public function removeItem($selected)
    {
        $this->{$selected[0]} = $this->{$selected[0]}->reject(
            fn ($item) => $item['id'] === $selected[1]['id']
        );
    }

    public function clearFields()
    {
        $this->from = null;
        $this->to = null;
        $this->exportFiches = false;
        $this->selectedActions = [];
        $this->selectedCalls = [];
        $this->selectedStatuses = [];
    }

    public function submit()
    {
        $params = $this->buildParams();
        $export = new DossiersExport($params);

        if ($this->exportFiches) {
            $export = new FichesWithCrews($params);
        } else {
            if (
                $this->selectedActions->every(fn ($item) => in_array($item['label'], ['FILMOVE'])
                || Call::whereIn('id', $this->selectedCalls->pluck('value'))
                    ->every(fn ($call) => in_array($call->action->name, ['FILMOVE'])))
            ) {
                // Get distribution for DIST fiches (only FILMOVE so far)
                $export = new DossiersWithDistribution($params);
            }
        }

        $filename = ($this->exportFiches ? 'fiches' : 'dossiers') . '-' . date('U') . '.xlsx';

        return $export->download($filename);
    }

    public function render()
    {
        return view('livewire.export', [
            'actions' => Action::all()
                ->map(fn ($action) => [
                    'label' => $action->name,
                    'value' => $action->id,
                ]),
            'calls' => Call::all()
                ->map(fn ($call) => [
                    'label' => $call->name,
                    'value' => $call->id,
                ]),
            'statuses' => Status::forDossier()
                    ->get()
                    ->map(fn ($status) => [
                        'label' => $status->name,
                        'value' => $status->id,
                    ])
        ])->layout('components.layout');
    }
}
