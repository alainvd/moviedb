<?php

namespace App\Http\Livewire\Dossiers;

use App\Models\Activity;
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
            $this->saveMovie();
            return redirect(route('dossiers.show', $this->dossier));
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

    protected function saveMovie()
    {
        $action = $this->dossier->action->name;

        switch ($action) {
            case 'DISTSEL':
            case 'DISTSAG':
                $this->dossier->fiches()->sync([$this->movie->fiche->id]);
                break;
            case 'DEVSLATE':
            case 'DEVSLATEMINI':
            case 'CODEVELOPMENT':
                // Attach fiche for previous-work activity
                $this->dossier->fiches()->attach(
                    $this->movie->fiche->id,
                    ['activity_id' => Activity::where('name', 'previous-work')->first()->id]
                );
            default:
                break;
        }
    }

    public function render()
    {
        $results = collect([]);
        $hasSearch = false;

        $query = Movie::whereHas('fiche', function ($query) {
                $query->whereNotIn('status_id', function ($query) {
                    $query->select('id')
                        ->from('statuses')
                        ->whereIn('name', ['Duplicated']);
                });
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
