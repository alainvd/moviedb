<?php

namespace App\Http\Livewire;

use App\Models\Crew;
use App\Models\Fiche;
use App\Models\Location;
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
use Illuminate\Support\MessageBag;

class MovieDevCurrentForm extends FicheMovieFormBase
{

    protected function getListeners()
    {
        return array_merge(
            parent::getListeners(), [
            'updateMovieCrews',
            'updateMovieLocations',
            'updateMovieProducers',
            'updateMovieSalesAgents',
        ]);
    }

    /**
     * Each wired fields needs to be here or it will be filtered
     */
    protected $rules = [
        'movie.original_title' => 'required|string|max:255',
        'fiche.status_id' => 'required|integer',
        'movie.film_country_of_origin' => 'string',
        'movie.audience_id' => 'required|integer',
        'movie.genre_id' => 'required|integer',
        'movie.delivery_platform' => 'required|string',
        'movie.user_experience' => 'required|string',
        'movie.film_type' => 'required|string',

        'movie.imdb_url' => 'string|max:255',
        'movie.isan' => 'string|max:255',
        'movie.synopsis' => 'required|string',

        'movie.photography_start' => 'required|date:d.m.Y',
        'movie.shooting_language' => 'required',
        'movie.development_costs_in_euro' => 'required|integer',
        'movie.film_length' => 'required|integer|max:10000',
        'movie.number_of_episodes' => 'integer|max:10000',
        'movie.length_of_episodes' => 'integer|max:10000',

        'movie.rights_origin_of_work' => 'required|string',
        'movie.rights_contract_type' => 'required|string',
        'movie.rights_contract_start_date' => 'required|date:d.m.Y',
        'movie.rights_contract_end_date' => 'required|date:d.m.Y',
        'movie.rights_contract_signature_date' => 'required|date:d.m.Y',
        // dependent fields
        'movie.rights_adapt_author_name' => 'string|requiredIf:movie.rights_origin_of_work,ADAPTATION',
        'movie.rights_adapt_original_title' => 'string|requiredIf:movie.rights_origin_of_work,ADAPTATION',
        'movie.rights_adapt_contract_type' => 'string|requiredIf:movie.rights_origin_of_work,ADAPTATION',
        'movie.rights_adapt_contract_start_date' => 'date:d.m.Y|requiredIf:movie.rights_origin_of_work,ADAPTATION',
        'movie.rights_adapt_contract_end_date' => 'date:d.m.Y|requiredIf:movie.rights_origin_of_work,ADAPTATION',
        'movie.rights_adapt_contract_signature_date' => 'date:d.m.Y|requiredIf:movie.rights_origin_of_work,ADAPTATION',

        'movie.total_budget_euro' => 'required|integer',

        'fiche.comments' => 'string',
    ];

    protected $rulesDraft = [
        'movie.original_title' => 'required|string|max:255',
        'fiche.status_id' => 'integer',
        'movie.film_country_of_origin' => 'string',
        'movie.audience_id' => 'integer',
        'movie.genre_id' => 'integer',
        'movie.delivery_platform' => 'string',
        'movie.user_experience' => 'string',
        'movie.film_type' => 'string',

        'movie.imdb_url' => 'string|max:255',
        'movie.isan' => 'string|max:255',
        'movie.synopsis' => 'string',

        'movie.photography_start' => 'date:d.m.Y',
        'movie.shooting_language' => '',
        'movie.development_costs_in_euro' => 'integer',
        'movie.film_length' => 'integer|max:10000',
        'movie.number_of_episodes' => 'integer|max:10000',
        'movie.length_of_episodes' => 'integer|max:10000',

        'movie.rights_origin_of_work' => 'string',
        'movie.rights_contract_type' => 'string',
        'movie.rights_contract_start_date' => 'date:d.m.Y',
        'movie.rights_contract_end_date' => 'date:d.m.Y',
        'movie.rights_contract_signature_date' => 'date:d.m.Y',
        // dependent fields
        'movie.rights_adapt_author_name' => 'string',
        'movie.rights_adapt_original_title' => 'string',
        'movie.rights_adapt_contract_type' => 'string',
        'movie.rights_adapt_contract_start_date' => 'date:d.m.Y',
        'movie.rights_adapt_contract_end_date' => 'date:d.m.Y',
        'movie.rights_adapt_contract_signature_date' => 'date:d.m.Y',

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
        $messages = FormHelpers::requiredCrew($this->crews, $this->movie->genre_id);
        foreach ($messages as $message) $specialErrors->add('crewErrorMessages', $message);
        // Validate subform: if all item fields are filled
        $messages = FormHelpers::validateTableEditItems($this->isEditor, $this->crews, TableEditMovieCrewsDevCurrent::class, function($crew) {return Title::find($crew['title_id'])->name;});
        foreach ($messages as $message) $specialErrors->add('crewErrorMessages', $message);

        // Validate subform: if required items are added
        $messages = FormHelpers::requiredLocations($this->locations, $this->movie->genre_id);
        foreach ($messages as $message) $specialErrors->add('locationErrorMessages', $message);
        // Validate subform: if all item fields are filled
        $messages = FormHelpers::validateTableEditItems($this->isEditor, $this->locations, TableEditMovieLocations::class, function($location) {return Location::LOCATION_TYPES[$location['type']];});
        foreach ($messages as $message) $specialErrors->add('locationErrorMessages', $message);

        // Validate subform
        $messages = FormHelpers::validateTableEditItems($this->isEditor, $this->producers, TableEditMovieProducersDevCurrent::class, function($producer) {return $producer['role'];});
        foreach ($messages as $message) $specialErrors->add('producerErrorMessages', $message);

        return $specialErrors;
    }

    public function fichePostSave()
    {
        // crew, location, producers, sales agents
        $this->saveItems(Crew::with('person')->where('movie_id',$this->movie->id)->get(), $this->crews, 'person_crew');
        $this->saveItems(Location::where('movie_id',$this->movie->id)->get(), $this->locations, Location::class);
        $this->saveItems(Producer::where('movie_id', $this->movie->id)->get(), $this->producers, Producer::class);
        $this->saveItems(SalesAgent::where('movie_id', $this->movie->id)->get(), $this->sales_agents, SalesAgent::class);
        // back
        return redirect()->to($this->previous);
    }

    public function render()
    {
        parent::render();

        $title = 'Films - Current work';
        $crumbs[] = [
            'url' => route('dossiers.index'),
            'title' => 'My dossiers'
        ];
        if (isset($this->dossier)) {
            $crumbs[] = [
                'url' => route('dossiers.show', $this->dossier),
                'title' => 'Edit dossier'
            ];
        }
        $crumbs[] = [
            'title' => 'Edit fiche'
        ];

        $layout = 'components.' . ($this->isApplicant ? 'ecl-layout' : 'layout');

        return view('livewire.movie-dev-current-form', [
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
