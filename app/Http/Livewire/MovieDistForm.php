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
        'movie.synopsis' => 'required|string',

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
        'movie.film_country_of_origin_2014_2020' => 'string',
        'movie.year_of_copyright' => 'integer',
        'movie.genre_id' => 'required|integer',
        'movie.delivery_platform' => 'required|string',
        'movie.audience_id' => 'required|integer',
        'movie.film_type' => 'required|string',

        'movie.imdb_url' => 'string|max:255',
        'movie.isan' => 'string|max:255',
        'movie.synopsis' => 'required|string',

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

    /*
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
        $this->emit('locationErrorMessages', array_merge(
            // TODO: required locations
            // FormHelpers::requiredCrew($this->crews, $this->movie->genre_id),
            FormHelpers::validateTableEditItems($this->isEditor, $this->locations, TableEditMovieLocations::class, function($location) {return $location['name'];})
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
    */

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
        
        $layout = 'components.' . ($this->isApplicant ? 'ecl-layout' : 'layout');

        return view('livewire.movie-dist-form', [
                'rules' => $this->rules(),
                'layout' => $layout,
            ])
            ->layout($layout, [
                'title' => $title,
                'crumbs' => $crumbs,
            ]);

    }

}
