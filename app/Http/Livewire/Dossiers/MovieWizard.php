<?php

namespace App\Http\Livewire\Dossiers;

use App\Models\User;
use App\Models\Movie;
use App\Models\Dossier;
use Livewire\Component;
use App\Models\Activity;
use App\Models\Admission;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Log;
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

        // Note: this serves the wizard (when attaching existing fiche, I believe)

        switch ($action) {
            // TODO: Wizard is only available to some of these actions
            // Or I could check for activity... it's always 'description' right?
            case 'FILMOVE':
            case 'DISTSAG':
            case 'DEVSLATE':
            case 'DEVMINISLATE':
            case 'CODEV':
            case 'TVONLINE':
                // Attach fiche for activity
                $rules = $this->dossier->action->activities->where('id', $this->activity->id)->first()->pivot->rules;
                if ($rules && isset($rules['movie_count']) && $rules['movie_count'] == 1) {
                    Log::info('wizard attach', ['attach 1']);
                    $this->dossier->fiches()->sync([$this->movie->fiche->id]);
                } else {
                    Log::info('wizard attach', ['attach 2']);
                    $this->dossier->fiches()->attach(
                        $this->movie->fiche->id,
                        ['activity_id' => $this->activity->id]
                    );
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
                    $admission->fiche_id = $this->movie->fiche->id;
                    $admission->save();
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
                'crumbs' => [
                    [
                        'url' => route('dossiers.index'),
                        'title' => 'My dossiers',
                    ],
                    [
                        'title' => 'Edit dossier',
                        'url' => route('dossiers.show', $this->dossier)
                    ],
                    [
                        'title' => 'Select work'
                    ]
                ],
                'title' => 'Films on the move',
                'class' => 'wizard-page',
            ]);
    }
}
