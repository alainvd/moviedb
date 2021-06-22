<?php

namespace App\Http\Livewire\Dossiers\Activities;

use App\Models\Dossier;
use App\Models\Distributor;
use App\Models\Fiche;
use App\Models\Movie;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Distributors extends Component
{
    // public $coordinatorCount = 0;
    public $participantCount = 0;

    public Dossier $dossier;

    public $isBackoffice = false;

    public $showAddModal = false;
    public $showDeleteModal = false;
    public $showNoMovieModal = false;

    public $editId = null;
    public $deleteId = null;

    // The authenticated user
    public User $user;

    public Distributor $currentDistributor;

    public ?Movie $movie = null;

    public $print = false;

    public $rules = [
        'currentDistributor.country_id' => 'required|integer',
        'currentDistributor.name' => 'required|string',
        'currentDistributor.role' => 'string',
        'currentDistributor.forecast_release_date' => 'required|date',
        'currentDistributor.pa_costs' => 'integer',
        'currentDistributor.forecast_grant' => 'integer',
    ];

    public function mount(Dossier $dossier)
    {
        $this->user = Auth::user();
        $this->isBackoffice = $this->user->hasAnyRole(['editor', 'admin']);
        $this->currentDistributor = new Distributor();

        $fiche = $dossier->fiches()->first();

        if ($fiche) {
            $this->movie = $fiche->movie;
        } else {
            $id = request()->query('movie_id', null);
            if ($id) {
                $this->movie = Movie::find($id);
            }
        }
    }

    public function getFicheProperty()
    {
        return $this->dossier->fiches()->first();
    }

    public function showAdd($id = null)
    {
        if (! $this->movie) {
            $this->showNoMovieModal = true;
            return;
        }

        if ($id) {
            $this->editId = $id;
            $this->currentDistributor = $this->movie
                ->distributors()
                ->find($id);
        } else {
            $this->editId = null;
            $this->currentDistributor = new Distributor();
        }

        $this->showAddModal = true;
        $this->emit('showModalInit_Distributors', []);
    }

    public function showDelete($id)
    {
        $this->showDeleteModal = true;
        $this->deleteId = $id;
    }

    public function addDistributor()
    {
        $this->validate();

        if ($this->editId) {
            $this->currentDistributor->updated_by = $this->user->id;
            $this->movie
                ->distributors()
                ->find($this->editId)
                ->update($this->currentDistributor->toArray());
        } else {
            $this->currentDistributor->created_by = $this->user->id;
            $this->movie
                ->distributors()
                ->save($this->currentDistributor);
        }

        $this->currentDistributor = new Distributor();
        $this->showAddModal = false;
    }

    public function deleteDistributor()
    {
        $this->movie->distributors()
            ->find($this->deleteId)
            ->delete();
        $this->deleteId = null;
        $this->showDeleteModal = false;
    }

    public function render()
    {
        $distributors = collect([]);

        if ($this->movie) {
            $distributors = $this->movie->distributors();
            $this->participantCount = $distributors->count();
        }

        return view('livewire.dossiers.activities.distributors', [
            'distributors' => $distributors->count() ? $distributors->get() : collect([]),
            'print' => $this->print,
        ]);
    }
}
