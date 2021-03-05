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

class MovieTVForm extends FicheMovieFormBase
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
            'totalPointsCrews',
            'totalPointsLocations',
        ]);
    }

    protected $rulesApplicant = [
        'movie.original_title' => 'required|string|max:255',
        'fiche.status_id' => 'required|integer',
        'movie.film_country_of_origin' => 'string',
        'movie.genre_id' => 'required|integer',
        'movie.delivery_platform' => 'required|string',
        'movie.audience_id' => 'required|integer',
        'movie.film_type' => 'required|string',

        'movie.imdb_url' => 'string|max:255',
        'movie.isan' => 'string|max:255',
        'movie.synopsis' => 'required|string',

        'movie.photography_start' => 'required|date:d.m.Y',
        'movie.photography_end' => 'required|date:d.m.Y',
        'movie.delivery_date' => 'required|date:d.m.Y',
        'movie.broadcast_date' => 'required|date:d.m.Y',
        'movie.shooting_language' => 'required',
        'movie.development_costs_in_euro' => 'required|integer',
        'movie.film_length' => 'required|integer',
        'movie.number_of_episodes' => 'integer',
        'movie.length_of_episodes' => 'integer',

        'movie.dev_support_flag' => 'required|integer',
        'movie.dev_support_reference' => 'string|requiredIf:movie.dev_support_flag,1',

        'movie.total_budget_euro' => 'integer',
    ];

    protected $rulesEditor = [
        'movie.original_title' => 'required|string|max:255',
        'fiche.status_id' => 'required|integer',
        'movie.film_country_of_origin' => 'string',
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
        'movie.delivery_date' => 'required|date:d.m.Y',
        'movie.broadcast_date' => 'required|date:d.m.Y',
        'movie.shooting_language' => 'required',
        'movie.development_costs_in_euro' => 'required|integer',
        'movie.film_length' => 'required|integer',
        'movie.number_of_episodes' => 'integer',
        'movie.length_of_episodes' => 'integer',

        'movie.dev_support_flag' => 'required|integer',
        'movie.dev_support_reference' => 'string|requiredIf:movie.dev_support_flag,1',

        'movie.total_budget_euro' => 'integer',

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

        return $specialErrors;
    }

    public function fichePostSave()
    {
        // crew, location, producers
        $this->saveItems(Crew::with('person')->where('movie_id',$this->movie->id)->get(), $this->crews, 'person_crew');
        $this->saveItems(Location::where('movie_id',$this->movie->id)->get(), $this->locations, Location::class);
        $this->saveItems(Producer::where('movie_id', $this->movie->id)->get(), $this->producers, Producer::class);

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

        $title = 'Audiovisual Work - Production - TV and Online';
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

        return view('livewire.movie-tv-form', [
                'rules' => $this->rules(),
                'layout' => $layout,
            ])
            ->layout($layout, [
                'title' => $title,
                'crumbs' => $crumbs,
            ]);

    }

}

