<?php

namespace App\Http\Livewire\Dossiers;

use App\Dossier;
use App\Media;
use App\Models\Activity;
use App\Models\Fiche;
use App\Movie;
use App\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class MovieWizard extends Component
{
    use WithPagination;

    public $currentStep = 1;
    public $maxStep = 3;

    // Fields
    public $originalTitle;
    public $director;
    // public $selectedMovie;

    protected $rules = [
        'originalTitle' => 'required_without:director',
        'director' => 'sometimes',
    ];

    public Dossier $dossier;
    public Movie $movie;

    public User $user;

    public function mount(Dossier $dossier)
    {
        $this->dossier = $dossier;
        $this->movie = new Movie();
        $this->user = Auth::user();
    }

    public function updatingOriginalTitle()
    {
        $this->resetPage();
    }

    public function nextStep()
    {
        if ($this->currentStep === 1) {
            $this->validate();
        }

        if ($this->currentStep === 2) {
            if (! $this->movie->id) {
                return;
            }
        }

        if ($this->currentStep === 3) {
            return redirect(route('dossiers.show', [
                'dossier' => $this->dossier,
                'movie_id' => $this->movie->id
            ]));
        }

        $this->currentStep++;
    }

    public function previousStep()
    {
        $this->currentStep--;
    }

    public function selectMovie($id)
    {
        $this->movie = Media::find($id)->grantable;
    }

    public function render()
    {
        $results = collect([]);
        $hasSearch = false;

        $query = Media::where('grantable_type', 'App\Movie')
            ->join('movies', 'media.grantable_id', '=', 'movies.id')
            ->with('grantable')
            ->with('fiche')
            ->with('people');

        if ($this->originalTitle) {
            $hasSearch = true;
            $query->where('movies.original_title', 'like', "%{$this->originalTitle}%");
        }

        if ($this->director) {
            $hasSearch = true;
            $query->where(function ($query) {
                $query->select('titles.code')
                    ->from('crews')
                    ->join('people', 'people.id', '=', 'crews.person_id')
                    ->join('titles', 'titles.id', '=', 'crews.title_id')
                    ->whereColumn('crews.media_id', 'media.id')
                    ->whereRaw("CONCAT(people.firstname, ' ', people.lastname) like '%{$this->director}%'");
            }, 'DIRECTOR');
        }

        if ($hasSearch) {
            $results = $query->simplePaginate(5);
        }

        $layout = 'components.' . ($this->user->hasRole('applicant') ? 'ecl-layout' : 'layout');

        return view('livewire.dossiers.movie-wizard', [
                'results' => $results,
            ])
            ->layout($layout, ['title' => 'Films on the move']);
    }
}
