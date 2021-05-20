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
use App\Models\Location;
use App\Models\Producer;
use App\Models\SalesAgent;
use Illuminate\Support\Str;
use App\Helpers\FormHelpers;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;

class MovieDistForm extends FicheMovieFormBase
{

    public $totalPointsCrews = 0;
    public $totalPointsLocations = 0;
    public $totalPoints = 0;

    protected function getListeners()
    {
        return array_merge(
            parent::getListeners(), [
            'updateMovieCrews',
            'updateMovieLocations',
            'updateMovieProducers',
            'updateMovieSalesAgents',
            'updateMovieDocuments',
            'totalPointsCrews',
            'totalPointsLocations',
        ]);
    }

    protected $rulesApplicant = [
        'movie.original_title' => 'required|string|max:255',
        'fiche.status_id' => 'required|integer',
        'movie.film_country_of_origin' => 'string',
        'movie.film_country_of_origin_2014_2020' => 'string',
        'movie.year_of_copyright' => 'integer',
        'movie.genre_id' => 'required|integer',
        'movie.delivery_platform' => 'required|string',
        'movie.audience_id' => 'required|integer',
        'movie.film_type' => 'required|string',

        'movie.imdb_url' => 'string|max:255',
        'movie.isan' => 'string|max:255',
        'movie.synopsis' => 'required|string|max:4000',

        'movie.photography_start' => 'required|date:d.m.Y',
        'movie.photography_end' => 'required|date:d.m.Y',
        'movie.shooting_language' => 'required',
        'movie.film_length' => 'required|integer|min:1|max:10000',
        'movie.film_format' => 'required|string',

        'movie.total_budget_currency_amount' => 'required|integer',
        'movie.total_budget_currency_code' => 'required|string',
    ];

    protected $rulesEditor = [
        'movie.original_title' => 'required|string|max:255',
        'fiche.status_id' => 'required|integer',
        'movie.film_country_of_origin' => 'string',
        'movie.film_country_of_origin_2014_2020' => 'string',
        'movie.year_of_copyright' => 'integer',
        'movie.genre_id' => 'required|integer',
        'movie.delivery_platform' => 'required|string',
        'movie.audience_id' => 'required|integer',
        'movie.film_type' => 'required|string',

        'movie.imdb_url' => 'string|max:255',
        'movie.isan' => 'string|max:255',
        'movie.synopsis' => 'required|string|max:4000',

        'movie.country_of_origin_points' => 'numeric',
        'movie.photography_start' => 'required|date:d.m.Y',
        'movie.photography_end' => 'required|date:d.m.Y',
        'movie.shooting_language' => 'required',
        'movie.film_length' => 'required|integer|min:1|max:10000',
        'movie.film_format' => 'required|string|max:255',

        'movie.total_budget_currency_amount' => 'required|integer',
        'movie.total_budget_currency_code' => 'required|string|max:255',
        'movie.total_budget_currency_rate' => 'required|numeric',
        'movie.total_budget_euro' => 'required|integer',

        'fiche.comments' => 'string',
    ];

    protected $rulesDraft = [
        'movie.original_title' => 'required|string|max:255',
        'fiche.status_id' => 'integer',
        'movie.film_country_of_origin' => 'string',
        'movie.film_country_of_origin_2014_2020' => 'string',
        'movie.year_of_copyright' => 'integer',
        'movie.genre_id' => 'integer',
        'movie.delivery_platform' => 'string',
        'movie.audience_id' => 'integer',
        'movie.film_type' => 'string',

        'movie.imdb_url' => 'string|max:255',
        'movie.isan' => 'string|max:255',
        'movie.synopsis' => 'string|max:4000',

        'movie.country_of_origin_points' => 'numeric',
        'movie.photography_start' => 'date:d.m.Y',
        'movie.photography_end' => 'date:d.m.Y',
        'movie.shooting_language' => '',
        'movie.film_length' => 'integer|min:1|max:10000',
        'movie.film_format' => 'string|max:255',

        'movie.total_budget_currency_amount' => 'integer',
        'movie.total_budget_currency_code' => 'string|max:255',
        'movie.total_budget_currency_rate' => 'numeric',
        'movie.total_budget_euro' => 'integer',

        'fiche.comments' => 'string',
    ];

    public function rules() {
        if ($this->isEditor) {
            return $this->rulesEditor;
        } else {
            return $this->rulesApplicant;
        }
    }

    public function mount(Request $request)
    {
        parent::mount($request);
        // init points value
        foreach($this->crews as $crew) {
            $this->totalPointsCrews += $crew['points'];
        }
        foreach($this->locations as $location) {
            $this->totalPointsLocations += $location['points'];
        }
        $this->totalPoints = $this->totalPointsCrews + $this->totalPointsLocations;
    }

    public function totalPointsCrews($points)
    {
        $this->totalPointsCrews = $points;
        $this->totalPoints = $this->totalPointsCrews + $this->totalPointsLocations;
    }

    public function totalPointsLocations($points)
    {
        $this->totalPointsLocations = $points;
        $this->totalPoints = $this->totalPointsCrews + $this->totalPointsLocations;
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
        $messages = FormHelpers::validateTableEditItems($this->isEditor, $this->crews, TableEditMovieCrews::class, function($crew) {return Title::find($crew['title_id'])->name;});
        foreach ($messages as $message) $specialErrors->add('crewErrorMessages', $message);

        // Validate subform: if required items are added
        $messages = FormHelpers::requiredLocations($this->locations, $this->movie->genre_id);
        foreach ($messages as $message) $specialErrors->add('locationErrorMessages', $message);
        // Validate subform: if all item fields are filled
        $messages = FormHelpers::validateTableEditItems($this->isEditor, $this->locations, TableEditMovieLocations::class, function($location) {return Location::LOCATION_TYPES[$location['type']];});
        foreach ($messages as $message) $specialErrors->add('locationErrorMessages', $message);    

        // Validate subform
        $messages = FormHelpers::validateTableEditItems($this->isEditor, $this->producers, TableEditMovieProducers::class, function($producer) {return $producer['role'];});
        foreach ($messages as $message) $specialErrors->add('producerErrorMessages', $message);

        // Validate subform
        $messages = FormHelpers::validateTableEditItems($this->isEditor, $this->sales_agents, TableEditMovieSalesAgents::class, function($sales_agent) {return $sales_agent['name'];});
        foreach ($messages as $message) $specialErrors->add('salesAgentErrorMessages', $message);

        // Validate subform
        $messages = FormHelpers::validateDocumentsFinancingPlan($this->documents);
        foreach ($messages as $message) $specialErrors->add('filesErrorMessages', $message);

        return $specialErrors;
    }

    public function fichePostSave()
    {
        // crew, location, producers, sales agents, documents
        $this->saveItems(Crew::with('person')->where('movie_id',$this->movie->id)->get(), $this->crews, 'person_crew');
        $this->saveItems(Location::where('movie_id',$this->movie->id)->get(), $this->locations, Location::class);
        $this->saveItems(Producer::where('movie_id', $this->movie->id)->get(), $this->producers, Producer::class);
        $this->saveItems(SalesAgent::where('movie_id', $this->movie->id)->get(), $this->sales_agents, SalesAgent::class);
        $this->saveItems(Document::where('movie_id', $this->movie->id)->get(), $this->documents, Document::class);

        // back
        // if coming from wizard, go to dossier
        if (Str::endsWith($this->previous, 'movie-wizard')) {
            return redirect()->route('dossiers.show', ['dossier' => $this->dossier]);
        } else {
            return redirect()->to($this->previous);
        }
    }

    public function render()
    {
        parent::render();

        $title = 'Films - Distribution';
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

        return view('livewire.movie-dist-form', [
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
