<?php

namespace App\Http\Livewire\Dossiers\Activities;

use App\Models\Distributor;
use App\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Distributors extends Component
{
    public $coordinatorCount = 0;
    public $participantCount = 0;

    public $showAddModal = false;
    public $showDeleteModal = false;

    public $editIndex = null;
    public $deleteIndex = null;

    // The authenticated user
    public User $user;
    public $isBackoffice = false;

    public $distributors = [];
    public Distributor $currentDistributor;

    protected $rules = [
        'currentDistributor.country_id' => 'required|integer',
        'currentDistributor.name' => 'required|string',
        'currentDistributor.role' => 'string',
        'currentDistributor.forecast_release_date' => 'required|date:d.m.Y',
        'currentDistributor.forecast_grant' => 'integer',
    ];

    public function mount()
    {
        $this->user = Auth::user();
        $this->isBackoffice = $this->user->hasAnyRole(['editor', 'admin']);
        $this->currentDistributor = new Distributor();
    }

    public function showAdd($index = null)
    {
        if (is_int($index)) {
            $this->editIndex = $index;
            $this->currentDistributor = Distributor::make($this->distributors[$index]);
        } else {
            $this->editIndex = null;
        }

        $this->showAddModal = true;
    }

    public function showDelete($index)
    {
        $this->showDeleteModal = true;
        $this->deleteIndex = $index;
    }

    public function showNoMovie()
    {

    }

    public function addDistributor()
    {
        $this->validate();

        // Force eager loading of country
        $country = $this->currentDistributor->country;

        // Replace at index if editing, else push
        if (is_int($this->editIndex)) {
            $this->distributors[$this->editIndex] = $this->currentDistributor->toArray();
        } else $this->distributors[] = $this->currentDistributor->toArray();

        $this->currentDistributor = new Distributor();
        $this->showAddModal = false;
    }

    public function deleteDistributor()
    {
        unset($this->distributors[$this->deleteIndex]);
        $this->deleteIndex = null;
        $this->showDeleteModal = false;
    }

    public function render()
    {
        return view('livewire.dossiers.activities.distributors');
    }
}
