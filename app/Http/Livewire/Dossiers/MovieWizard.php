<?php

namespace App\Http\Livewire\Dossiers;

use App\Models\Dossier;
use App\Models\Movie;
use App\Models\User;
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
            // @todo - instead of a get variable, save the corresponding fiche
            // on the dossier
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
        $this->movie = Movie::find($id);
    }

    public function render()
    {
        $results = collect([]);
        $hasSearch = false;

        $query = Movie::join('fiches', 'fiches.movie_id', '=', 'movies.id')
            ->whereNotIn('fiches.status_id', function ($query) {
                $query->select('id')
                    ->from('statuses')
                    ->whereIn('name', ['Duplicated']);
            });

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
                    ->whereColumn('crews.movie_id', 'movies.id')
                    ->whereRaw("CONCAT(people.firstname, ' ', people.lastname) like '%{$this->director}%'")
                    ->limit(1);
            }, 'DIRECTOR');
        }

        if ($hasSearch) {
            $results = $query->simplePaginate(5);
        }

        $layout = 'components.' . ($this->user->hasRole('applicant') ? 'ecl-layout' : 'layout');

        return view('livewire.dossiers.movie-wizard', [
                'results' => $results,
            ])
            ->layout($layout, [
                'title' => 'Films on the move',
                'class' => 'wizard-page',
            ]);
    }
}
