<?php

namespace App\Http\Livewire\Dossiers;

use App\Models\User;
use App\Models\Movie;
use App\Models\Dossier;
use Livewire\Component;
use App\Models\Activity;
use App\Models\Admission;
use App\Models\Reinvested;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Models\Activity as ActivityLog;

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

    public Activity $activity;

    public $admissionsTable = null;
    public $admission = null;
    public $reinvested = null;

    public function mount(Dossier $dossier, Activity $activity)
    {
        if (request()->user()->cannot('update', $dossier)) {
            return abort(404);
        }

        $this->dossier = $dossier;
        $this->movie = new Movie();
        $this->user = Auth::user();
        $this->activity = $activity;
        if (request()->input('admissionsTable')) $this->admissionsTable = request()->input('admissionsTable');
        if (request()->input('admission')) $this->admission = request()->input('admission');
        if (request()->input('reinvested')) $this->reinvested = request()->input('reinvested');
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
            if ($this->admissionsTable && $this->admission) {
                $this->redirect(route('admission', [$this->dossier, $this->admissionsTable, $this->admission]));
            } else {
                return redirect(route('dossiers.show', $this->dossier));
            }
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
        // Note: this serves the wizard (when attaching existing fiche)
        // Wizard is only used to select and add one movie
        $action = $this->dossier->action->name;
        switch ($action) {
            case 'FILMOVE':
            case 'DISTSAG':
                if (Auth::user()->can('view', $this->dossier)) {
                    $this->dossier->fiches()->sync([$this->movie->fiche->id]);
                } else {
                    abort(404);
                }

                $hasMovie = ActivityLog::forSubject($this->dossier)
                    ->where('properties->model', 'Movie')
                    ->count();
                activity()->on($this->dossier)
                    ->by($this->user)
                    ->withProperties([
                        'model' => 'Movie',
                        'operation' => $hasMovie ? 'replaced' : 'attached',
                        'movie' => $this->movie->only(['id', 'original_title', 'year_of_copyright', 'isan', 'imdb_url', 'synopsis']),
                    ])
                    ->log('updated');
                $this->notify('Movie added/updated');
            case 'DISTAUTOG':
                if ($this->admissionsTable && $this->admission) {
                    $admission = Admission::find($this->admission);
                    if (Auth::user()->can('view', $admission->admissionsTable->dossier)) {
                        $admission->fiche_id = $this->movie->fiche->id;
                        $admission->save();
                    } else {
                        abort(404);
                    }
                }
                if ($this->reinvested) {
                    $reinvested = Reinvested::find($this->reinvested);
                    if (Auth::user()->can('view', $reinvested->dossier)) {
                        $reinvested->fiche_id = $this->movie->fiche->id;
                        $reinvested->save();
                    } else {
                        abort(404);
                    }
                }
                $this->notify('Movie added');
            default:
                break;
        }
    }

    public function render()
    {
        $results = collect([]);
        $hasSearch = false;

        $query = Movie::whereHas('fiche', function ($query) {
                $query->where('type', 'dist');
                $query->whereNotIn('status_id', function ($query) {
                    $query->select('id')
                        ->from('statuses')
                        ->whereIn('name', ['Duplicated', 'Draft']);
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
                'crumbs' => $this->getCrumbs(),
                'title' => 'Films on the move',
                'class' => 'wizard-page',
            ]);
    }

    public function getCrumbs() {
        $routes[] = [
                'url' => route('dossiers.index'),
                'title' => 'My dossiers',
            ];
        $routes[] = [
                'title' => 'Edit dossier',
                'url' => route('dossiers.show', $this->dossier)
            ];
        if ($this->admissionsTable && $this->admission) {
            $routes[] = [
                'title' => 'Edit admission',
                'url' => route('admission', [$this->dossier, $this->admissionsTable, $this->admission])
            ];
        }
        $routes[] = [
            'title' => 'Select work'
        ];
        return $routes;
    }
}
