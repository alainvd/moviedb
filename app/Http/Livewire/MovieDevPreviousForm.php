<?php

namespace App\Http\Livewire;

use App\Models\Crew;
use App\Models\Fiche;
use App\Models\Movie;
use App\Models\Document;
use App\Models\Dossier;
use App\Models\Activity;
use App\Models\Person;
use App\Models\Producer;
use App\Models\SalesAgent;
use App\Helpers\FormHelpers;
use Illuminate\Http\Request;

class MovieDevPreviousForm extends FicheMovieFormBase
{

    protected function getListeners()
    {
        return array_merge(
            parent::getListeners(), [
            'updateMovieProducers',
            'updateMovieSalesAgents',
        ]);
    }

    protected $rules = [
        'movie.original_title' => 'required|string|max:255',
        'fiche.status_id' => 'required|integer',
        'movie.film_country_of_origin' => 'string',
        'movie.year_of_copyright' => 'integer',
        'movie.genre_id' => 'required|integer',

        'movie.imdb_url' => 'string|max:255',
        'movie.isan' => 'string|max:255',
        'movie.synopsis' => 'string',

        'movie.film_length' => 'required|integer',
        'movie.shooting_language' => 'required',
        'movie.audience_id' => 'required|integer',

        'movie.link_applicant_work' => 'string',
        'movie.link_applicant_work_person_name' => 'string',
        'movie.link_applicant_work_person_position' => 'string',
        'movie.link_applicant_work_person_credit' => 'string',

        'fiche.comments' => 'string',
    ];

    protected function rules()
    {
        return $this->rules;
    }

    public function callValidate()
    {
        // Validate form itself
        $this->movie->shooting_language = $this->shootingLanguages;
        $this->validate();
        unset($this->movie->shooting_language);

        // Validate subform
        $this->emit('producerErrorMessages',
            FormHelpers::validateTableEditItems($this->isEditor, $this->producers, TableEditMovieProducersDevPrevious::class, function($producer) {return $producer['role'];})
        );

        // Validate subform
        $this->emit('salesAgentErrorMessages',
            FormHelpers::validateTableEditItems($this->isEditor, $this->sales_agents, TableEditMovieSalesAgentsDevPrevious::class, function($sales_agent) {return $sales_agent['name'];})
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

        // producers, sales agents
        $this->saveItems(Producer::where('movie_id', $this->movie->id)->get(), $this->producers, Producer::class);
        $this->saveItems(SalesAgent::where('movie_id', $this->movie->id)->get(), $this->sales_agents, SalesAgent::class);

        // if ($this->dossier->call_id && $this->dossier->project_ref_id) {
        //     return redirect()->route('projects.create', ['call_id' => $this->dossier->call_id, 'project_ref_id' => $this->dossier->project_ref_id]);
        // }
    }

    public function render()
    {
        parent::render();
        
        return view('livewire.movie-dev-previous-form', ['rules' => $this->rules()])
            ->layout('components.layout');
    }

}
