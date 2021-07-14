<?php

namespace App\Http\Livewire;


use App\Models\Producer;
use App\Models\SalesDistributor;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use App\Helpers\FormHelpers;


class VideoGameCurrentForm extends FicheMovieFormBase
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
        'movie.audience_id' => 'required|integer',

        'movie.imdb_url' => 'string|max:255',
        'movie.isan' => 'string|max:255',
        'movie.synopsis' => 'required|string|max:4000',

        'movie.photography_start' => 'date',
        'movie.photography_end' => 'date',
        'movie.shooting_language' => 'required',

        'movie.rights_origin_of_work' => 'required|string',
        'movie.rights_contract_type' => 'required|string',
        'movie.rights_contract_start_date' => 'required|date',
        'movie.rights_contract_end_date' => 'required',
        'movie.rights_contract_signature_date' => 'required',
        // dependent fields
        'movie.rights_adapt_author_name' => 'string|requiredIf:movie.rights_origin_of_work,ADAPTATION',
        'movie.rights_adapt_original_title' => 'string|requiredIf:movie.rights_origin_of_work,ADAPTATION',
        'movie.rights_adapt_contract_type' => 'string|requiredIf:movie.rights_origin_of_work,ADAPTATION',
        'movie.rights_adapt_contract_start_date' => 'date|requiredIf:movie.rights_origin_of_work,ADAPTATION',
        'movie.rights_adapt_contract_end_date' => 'date|requiredIf:movie.rights_origin_of_work,ADAPTATION',
        'movie.rights_adapt_contract_signature_date' => 'date|requiredIf:movie.rights_origin_of_work,ADAPTATION',

        'movie.total_budget_euro' => 'required|integer',

        'fiche.comments' => 'string',
    ];

    protected $rulesDraft = [
        'movie.original_title' => 'required|string|max:255',
        'fiche.status_id' => 'required|integer',
        'movie.film_country_of_origin' => 'string',
        'movie.year_of_copyright' => 'integer',
        'movie.genre_id' => 'integer',
        'movie.game_genres' => 'string',        
        'movie.delivery_platform' => 'string',
        'movie.audience_id' => 'integer',
        'movie.game_audiences' => 'string',
        
        'movie.imdb_url' => 'string|max:255',
        'movie.isan' => 'string|max:255',
        'movie.synopsis' => 'string|max:4000',

        'movie.photography_start' => 'date',
        'movie.photography_end' => 'date',
        'movie.shooting_language' => '',
        'movie.film_length' => 'integer|min:1|max:10000',
        'movie.film_format' => 'string',

        'movie.rights_origin_of_work' => 'string',
        'movie.rights_contract_type' => 'string',
        'movie.rights_contract_start_date' => 'date',
        'movie.rights_contract_end_date' => 'date',
        'movie.rights_contract_signature_date' => 'date',
        // dependent fields
        'movie.rights_adapt_author_name' => 'string',
        'movie.rights_adapt_original_title' => 'string',
        'movie.rights_adapt_contract_type' => 'string',
        'movie.rights_adapt_contract_start_date' => 'date',
        'movie.rights_adapt_contract_end_date' => 'date',
        'movie.rights_adapt_contract_signature_date' => 'date',

        'movie.total_budget_euro' => 'integer',

        'fiche.comments' => 'string',
    ];

    public function rules()
    {
        return $this->rules;
    }

    public function mount(Request $request)
    {
        parent::mount($request);
        $type='vg-current';
        $this->fiche->type='vg-current';
        if ($this->fiche->exists && $this->fiche->type!=='vg-current') {
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

        // Validate subform: if required items are added
        $messages = FormHelpers::requiredProducers($this->producers);
        foreach ($messages as $message) $specialErrors->add('producerErrorMessages', $message);
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

        $title = 'Video Game - Development - For grant request';
        $layout = 'components.' . ($this->isApplicant ? 'ecl-layout' : 'layout');

        return view('livewire.video-game-current-form', [
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


