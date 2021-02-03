<?php

namespace App\Http\Livewire\Dossiers\Activities;

use App\Models\Dossier;
use App\Models\Distributor;
use App\Models\Movie;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Distributors extends Component
{
    public $coordinatorCount = 0;
    public $participantCount = 0;

    public $showAddModal = false;
    public $showDeleteModal = false;
    public $showNoMovieModal = false;

    public $editId = null;
    public $deleteId = null;

    // The authenticated user
    public User $user;
    public $isBackoffice = false;

    public $dists = [];
    public Distributor $currentDistributor;

    public Dossier $dossier;
    public Movie $movie;

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
        $this->movie = new Movie();

        $movieId = request('movie_id');
        $fiche = $this->dossier->fiches()->first();

        if ($fiche) {
            $this->movie = $fiche->media->grantable;
        } else if ($movieId) {
            $this->movie = Movie::find($movieId);
        }
    }

    public function showAdd($id = null)
    {
        if (! $this->movie->id) {
            $this->showNoMovieModal = true;
            return;
        }

        if ($id) {
            $this->editId = $id;
            $this->currentDistributor = $this->movie->media
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

        $this->currentDistributor->created_by = $this->user->id;
        if ($this->editId) {
            $this->movie->media
                ->distributors()
                ->find($this->editId)
                ->update($this->currentDistributor->toArray());
        } else {
            $this->movie->media
                ->distributors()
                ->save($this->currentDistributor);
        }

        $this->currentDistributor = new Distributor();
        $this->showAddModal = false;
    }

    public function deleteDistributor()
    {
        // unset($this->distributors[$this->deleteId]);
        $this->movie->media->distributors()
            ->find($this->deleteId)
            ->delete();
        $this->deleteId = null;
        $this->showDeleteModal = false;
    }

    public function render()
    {
        $distributors = collect([]);

        if ($this->movie->id) {
            $distributors = $this->movie->media->distributors();
        }

        return view('livewire.dossiers.activities.distributors', [
            'distributors' => $distributors->count() ? $distributors->get() : collect([]),
        ]);
    }
}
