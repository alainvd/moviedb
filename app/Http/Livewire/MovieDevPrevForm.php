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
use Illuminate\Support\MessageBag;

class MovieDevPrevForm extends FicheMovieFormBase
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
        'movie.year_of_copyright' => 'required|integer',
        'movie.genre_id' => 'required|integer',
        'movie.delivery_platform' => 'string',
        'movie.audience_id' => 'required|integer',
        'movie.film_type' => 'string',

        'movie.imdb_url' => 'string|max:255',
        'movie.isan' => 'string|max:255',
        'movie.synopsis' => 'required|string|max:4000',

        'movie.photography_start' => 'date',
        'movie.photography_end' => 'date',
        'movie.shooting_language' => 'required',
        'movie.film_length' => 'required|integer|min:1|max:10000',
        'movie.film_format' => 'string',

        'movie.link_applicant_work' => 'string',
        // dependent fields
        'movie.link_applicant_work_person_name' => 'string|requiredIf:movie.link_applicant_work,WRKPERS',
        'movie.link_applicant_work_person_position' => 'string|requiredIf:movie.link_applicant_work,WRKPERS',
        'movie.link_applicant_work_person_credit' => 'string|requiredIf:movie.link_applicant_work,WRKPERS',

        'fiche.comments' => 'string',
    ];

    protected $rulesDraft = [
        'movie.original_title' => 'required|string|max:255',
        'fiche.status_id' => 'required|integer',
        'movie.film_country_of_origin' => 'string',
        'movie.year_of_copyright' => 'integer',
        'movie.genre_id' => 'integer',
        'movie.delivery_platform' => 'string',
        'movie.audience_id' => 'integer',
        'movie.film_type' => 'string',

        'movie.imdb_url' => 'string|max:255',
        'movie.isan' => 'string|max:255',
        'movie.synopsis' => 'string|max:4000',

        'movie.photography_start' => 'date',
        'movie.photography_end' => 'date',
        'movie.shooting_language' => '',
        'movie.film_length' => 'integer|min:1|max:10000',
        'movie.film_format' => 'string',

        'movie.link_applicant_work' => 'string',
        // dependent fields
        'movie.link_applicant_work_person_name' => 'string',
        'movie.link_applicant_work_person_position' => 'string',
        'movie.link_applicant_work_person_credit' => 'string',

        'fiche.comments' => 'string',
    ];

    public function rules()
    {
        return $this->rules;
    }

    public function mount(Request $request)
    {
        parent::mount($request);
        if ($this->fiche->exists && $this->fiche->type!=='dev-prev') {
            abort(404);
        }
    }

    public function saveFiche()
    {
        parent::saveFiche();
    }

    public function submitFiche()
    {
        parent::submitFiche();
    }

    public function specialValidation()
    {
        $specialErrors = new MessageBag;

        // Validate subform: if all item fields are filled
        $messages = FormHelpers::validateTableEditItems($this->isEditor, $this->producers, TableEditMovieProducersDevPrevious::class, function($producer) {return $producer['role'];});
        foreach ($messages as $message) $specialErrors->add('producerErrorMessages', $message);

        // Validate subform: minimum territories
        $messages = FormHelpers::validateSalesDistributorTerritories($this->sales_distributors);
        foreach ($messages as $message) $specialErrors->add('salesDistributorErrorMessages', $message);
        // Validate subform: if all item fields are filled
        $messages = FormHelpers::validateTableEditItems($this->isEditor, $this->sales_distributors, TableEditMovieSalesDistributors::class, function($sales_distributor) {return $sales_distributor['name'];});
        foreach ($messages as $message) $specialErrors->add('salesDistributorErrorMessages', $message);

        return $specialErrors;
    }

    public function fichePostSave()
    {
        // producers, sales distributor
        $this->saveItems(Producer::where('movie_id', $this->movie->id)->get(), $this->producers, Producer::class);
        $this->saveItems(SalesDistributor::with('countries')->where('movie_id', $this->movie->id)->get(), $this->sales_distributors, 'sales_distributor_country');

        $this->fichePostSaveRedirect();
    }

    public function render()
    {
        parent::render();

        $title = 'Audiovisual Work - Development - Recent work / previous experience';
        $layout = 'components.' . ($this->isApplicant ? 'ecl-layout' : 'layout');

        return view('livewire.movie-dev-prev-form', [
                'rules' => $this->rules(),
                'layout' => $layout,
                'print' => false,
                'title' => $title,
                'crumbs' => $this->crumbs,
            ])
            ->layout($layout, [
                'title' => $title,
                'crumbs' => $this->crumbs,
            ]);

    }

}
