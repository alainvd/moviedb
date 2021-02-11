<?php

namespace App\Http\Livewire;

use App\Models\Crew;
use App\Models\Fiche;
use App\Models\Movie;
use App\Models\Title;
use App\Models\Person;
use App\Models\Dossier;
use App\Models\Activity;
use App\Models\Document;
use App\Models\Producer;
use App\Models\SalesAgent;
use App\Helpers\FormHelpers;
use Illuminate\Http\Request;

class MovieDistForm extends FicheMovieFormBase
{

    protected function getListeners()
    {
        return array_merge(
            parent::getListeners(), [
            'updateMovieCrews',
            'updateMovieProducers',
            'updateMovieSalesAgents',
            'updateMovieDocuments',
        ]);
    }

    protected $rulesApplicant = [
        'movie.original_title' => 'required|string|max:255',
        'fiche.status_id' => 'required|integer',
        'movie.film_country_of_origin' => 'string',
        'movie.year_of_copyright' => 'integer',
        'movie.genre_id' => 'required|integer',
        'movie.film_delivery_platform' => 'required|string',
        'movie.audience_id' => 'required|integer',
        'movie.film_type' => 'required|string',

        'movie.imdb_url' => 'string|max:255',
        'movie.isan' => 'string|max:255',
        'movie.synopsis' => 'string',

        'movie.photography_start' => 'required|date:d.m.Y',
        'movie.photography_end' => 'required|date:d.m.Y',
        'movie.shooting_language' => 'required',
        'movie.film_length' => 'required|integer',
        'movie.film_format' => 'required|string',

        'movie.total_budget_currency_amount' => 'required|integer',
        'movie.total_budget_currency_code' => 'required|string',
    ];

    protected $rulesEditor = [
        'movie.original_title' => 'required|string|max:255',
        'fiche.status_id' => 'required|integer',
        'movie.film_country_of_origin' => 'string',
        'movie.year_of_copyright' => 'integer',
        'movie.genre_id' => 'required|integer',
        'movie.film_delivery_platform' => 'required|string',
        'movie.audience_id' => 'required|integer',
        'movie.film_type' => 'required|string',

        'movie.imdb_url' => 'string|max:255',
        'movie.isan' => 'string|max:255',
        'movie.synopsis' => 'string',

        'movie.country_of_origin_points' => 'numeric',
        'movie.photography_start' => 'required|date:d.m.Y',
        'movie.photography_end' => 'required|date:d.m.Y',
        'movie.shooting_language' => 'required',
        'movie.film_length' => 'required|integer',
        'movie.film_format' => 'required|string|max:255',

        'movie.total_budget_currency_amount' => 'required|integer',
        'movie.total_budget_currency_code' => 'required|string|max:255',
        'movie.total_budget_currency_rate' => 'required|numeric',
        'movie.total_budget_euro' => 'required|integer',

        'fiche.comments' => 'string',
    ];

    protected function rules() {
        if ($this->isEditor) {
            return $this->rulesEditor;
        } else {
            return $this->rulesApplicant;
        }
    }

    public function callValidate()
    {
        // Validate form itself
        $this->movie->shooting_language = $this->shootingLanguages;
        $this->validate();
        unset($this->movie->shooting_language);

        // Validate subform
        $this->emit('crewErrorMessages', array_merge(
            FormHelpers::requiredCrew($this->crews, $this->movie->genre_id),
            FormHelpers::validateTableEditItems($this->isEditor, $this->crews, TableEditMovieCrews::class, function($crew) {return Title::find($crew['title_id'])->name;})
        ));

        // Validate subform
        $this->emit('producerErrorMessages',
            FormHelpers::validateTableEditItems($this->isEditor, $this->producers, TableEditMovieProducers::class, function($producer) {return $producer['role'];})
        );

        // Validate subform
        $this->emit('salesAgentErrorMessages',
            FormHelpers::validateTableEditItems($this->isEditor, $this->sales_agents, TableEditMovieSalesAgents::class, function($sales_agent) {return $sales_agent['name'];})
        );

        // Validate subform
        $this->emit('filesErrorMessages',
            FormHelpers::validateDocumentsFinancingPlan($this->documents)
        );
    }

    public function mount(Request $request)
    {
        parent::mount($request);
    }

    public function reject()
    {
        $this->fiche = new Fiche;
        $this->movie = new Movie;
    }

    public function submit()
    {
        parent::submit();

        // crew, producers, sales agents, documents
        $this->saveItems(Crew::with('person')->where('movie_id',$this->movie->id)->get(), $this->crews, 'person_crew');
        $this->saveItems(Producer::where('movie_id', $this->movie->id)->get(), $this->producers, Producer::class);
        $this->saveItems(SalesAgent::where('movie_id', $this->movie->id)->get(), $this->sales_agents, SalesAgent::class);
        $this->saveItems(Document::where('movie_id', $this->movie->id)->get(), $this->documents, Document::class);

        // if ($this->dossier->call_id && $this->dossier->project_ref_id) {
        //     return redirect()->route('projects.create', ['call_id' => $this->dossier->call_id, 'project_ref_id' => $this->dossier->project_ref_id]);
        // }
    }

    public function render()
    {
        parent::render();

        $title = 'Films - Distribution';
        $crumbs[] = [
            'url' => route('dossiers-public'),
            'title' => 'My dossiers'
        ];
        $crumbs[] = [
            'url' => route('dossiers-public'),
            'title' => 'Edit dossier'
        ];
        $crumbs[] = [
            'title' => 'Edit fiche'
        ];

        if ($this->isApplicant) {
            return view('livewire.movie-dist-form', ['rules' => $this->rules()])
                ->layout('components.ecl-layout', ['title' => $title, 'crumbs' => $crumbs]);
        } else {
            return view('livewire.movie-dist-form', ['rules' => $this->rules()])
                ->layout('components.layout', ['title' => $title, 'crumbs' => $crumbs, 'rules' => $this->rules()]);
        }
    }

}
