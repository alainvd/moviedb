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
    // public $participantCount = 0;

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

    protected $rules = [
        'currentDistributor.country_id' => 'required|integer',
        'currentDistributor.name' => 'required|string',
        'currentDistributor.role' => 'string',
        'currentDistributor.forecast_release_date' => 'required|date:d.m.Y',
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
    }

    public function showDelete($id)
    {
        $this->showDeleteModal = true;
        $this->deleteId = $id;
    }

    public function addDistributor()
    {
        $this->validate();

        // $this->currentDistributor->created_by = $this->user->id;
        if ($this->editId) {
            $this->movie
                ->distributors()
                ->find($this->editId)
                ->update($this->currentDistributor->toArray());
        } else {
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
        }

        return view('livewire.dossiers.activities.distributors', [
            'distributors' => $distributors->count() ? $distributors->get() : collect([]),
            'print' => $this->print,
        ]);
    }
}
