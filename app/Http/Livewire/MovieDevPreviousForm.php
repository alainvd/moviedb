<?php

namespace App\Http\Livewire;

use App\Models\Crew;
use App\Models\Fiche;
use App\Models\Movie;
use App\Models\Person;
use App\Models\Dossier;
use App\Models\Activity;
use App\Models\Document;
use App\Models\Producer;
use App\Models\SalesAgent;
use App\Helpers\FormHelpers;
use Illuminate\Http\Request;
use App\Models\SalesDistributor;

class MovieDevPreviousForm extends FicheMovieFormBase
{

    protected function getListeners()
    {
        return array_merge(
            parent::getListeners(), [
            'updateMovieProducers',
            'updateMovieSalesAgents',
            'updateMovieSalesDistributors',
        ]);
    }

    protected $rules = [
        'movie.original_title' => 'required|string|max:255',
        'fiche.status_id' => 'required|integer',
        'movie.film_country_of_origin' => 'string',
        'movie.year_of_copyright' => 'integer',
        'movie.genre_id' => 'required|integer',
        'movie.delivery_platform' => 'string',
        'movie.audience_id' => 'required|integer',
        'movie.film_type' => 'string',

        'movie.imdb_url' => 'string|max:255',
        'movie.isan' => 'string|max:255',
        'movie.synopsis' => 'string',

        'movie.photography_start' => 'date:d.m.Y',
        'movie.photography_end' => 'date:d.m.Y',
        'movie.shooting_language' => 'required',
        'movie.film_length' => 'required|integer',
        'movie.film_format' => 'string',

        'movie.link_applicant_work' => 'string',
        // dependant fields
        'movie.link_applicant_work_person_name' => 'string|requiredIf:movie.link_applicant_work,WRKPERS',
        'movie.link_applicant_work_person_position' => 'string|requiredIf:movie.link_applicant_work,WRKPERS',
        'movie.link_applicant_work_person_credit' => 'string|requiredIf:movie.link_applicant_work,WRKPERS',

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
        $errors1 = FormHelpers::validateTableEditItems($this->isEditor, $this->sales_agents, TableEditMovieSalesDistributor::class, function($sales_distributor) {return $sales_distributor['name'];});
        $errors2 = FormHelpers::validateSalesDistributorTerritories($this->sales_distributors);
        $this->emit('salesDistributorErrorMessages', array_merge($errors1, $errors2));
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

        // producers, sales distributor
        $this->saveItems(Producer::where('movie_id', $this->movie->id)->get(), $this->producers, Producer::class);
        $this->saveItems(SalesDistributor::with('countries')->where('movie_id', $this->movie->id)->get(), $this->sales_distributors, 'sales_distributor_country');

        // go back to dossier
        if ($this->dossier->call_id && $this->dossier->project_ref_id) {
            return redirect()->route('dossiers.show', ['dossier' => $this->dossier]);
        }
    }

    public function render()
    {
        parent::render();

        $title = 'Films - Previous work';
        
        if ($this->isApplicant) {
            return view('livewire.movie-dev-previous-form', ['rules' => $this->rules()])
                ->layout('components.ecl-layout', ['title' => $title]);
        } else {
            return view('livewire.movie-dev-previous-form', ['rules' => $this->rules()])
                ->layout('components.layout', ['title' => $title]);
        }
    }

}
