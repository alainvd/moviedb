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

class MovieDevCurrentForm extends FicheMovieFormBase
{

    protected function getListeners()
    {
        return array_merge(
            parent::getListeners(), [
            'updateMovieCrews',
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
        'movie.film_length' => 'required|integer',
        'movie.number_of_episodes' => 'integer',
        'movie.length_of_episodes' => 'integer',

        'movie.rights_origin_of_work' => 'required|string',
        'movie.rights_contract_type' => 'required|string',
        'movie.rights_contract_start_date' => 'required|date:d.m.Y',
        'movie.rights_contract_end_date' => 'required|date:d.m.Y',
        'movie.rights_contract_signature_date' => 'required|date:d.m.Y',
        // dependant fields
        'movie.rights_adapt_author_name' => 'string|requiredIf:movie.rights_origin_of_work,ADAPTATION',
        'movie.rights_adapt_original_title' => 'string|requiredIf:movie.rights_origin_of_work,ADAPTATION',
        'movie.rights_adapt_contract_type' => 'string|requiredIf:movie.rights_origin_of_work,ADAPTATION',
        'movie.rights_adapt_contract_start_date' => 'date:d.m.Y|requiredIf:movie.rights_origin_of_work,ADAPTATION',
        'movie.rights_adapt_contract_end_date' => 'date:d.m.Y|requiredIf:movie.rights_origin_of_work,ADAPTATION',
        'movie.rights_adapt_contract_signature_date' => 'date:d.m.Y|requiredIf:movie.rights_origin_of_work,ADAPTATION',

        'movie.total_budget_euro' => 'required|integer',

        'fiche.comments' => 'string',
    ];

    protected function rules()
    {
        return $this->rules;
    }

    public function mount(Request $request)
    {
        parent::mount($request);
    }

    // TODO: incorporate this in the main validation
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
            FormHelpers::validateTableEditItems($this->isEditor, $this->crews, TableEditMovieCrewsDevCurrent::class, function($crew) {return Title::find($crew['title_id'])->name;})
        ));

        // Validate subform
        $this->emit('producerErrorMessages',
            FormHelpers::validateTableEditItems($this->isEditor, $this->producers, TableEditMovieProducersDevCurrent::class, function($producer) {return $producer['role'];})
        );
    }
    */

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
        // crew, producers, sales agents
        $this->saveItems(Crew::with('person')->where('movie_id',$this->movie->id)->get(), $this->crews, 'person_crew');
        $this->saveItems(Producer::where('movie_id', $this->movie->id)->get(), $this->producers, Producer::class);
        $this->saveItems(SalesAgent::where('movie_id', $this->movie->id)->get(), $this->sales_agents, SalesAgent::class);
        // back
        return redirect()->to($this->previous);
    }

    public function render()
    {
        parent::render();

        $title = 'Films - Current work';

        $layout = 'components.' . ($this->isApplicant ? 'ecl-layout' : 'layout');

        return view('livewire.movie-dev-current-form', [
                'rules' => $this->rules(),
                'layout' => $layout,
            ])
            ->layout($layout, [
                'title' => $title,
            ]);
    }

}
