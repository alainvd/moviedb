<?php

namespace App\Http\Livewire;

use App\Models\Crew;
use App\Models\Fiche;
use App\Models\Genre;
use App\Models\Movie;
use App\Models\Person;
use App\Models\Country;
use App\Models\Dossier;
use Livewire\Component;
use App\Models\Activity;
use App\Models\Audience;
use App\Models\Language;
use App\Models\Producer;
use App\Models\SalesAgent;
use App\Helpers\FormHelpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class MovieDevPreviousForm extends Component
{

    public $isNew = false;
    public $isApplicant = false;
    public $isEditor = false;

    // Movie data for Livewire
    public Dossier $dossier;
    public Activity $activity;
    public ?Fiche $fiche = null;
    public ?Movie $movie = null;

    public $shootingLanguages;

    public $producers = [];
    public $sales_agents = [];

    protected $listeners = [
        'update-movie-producers' => 'updateMovieProducers',
        'update-movie-sales-agents' => 'updateMovieSalesAgents',
        'addItem' => 'addShootingLanguage',
        'removeItem' => 'removeShootingLanguage'
    ];

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
        $this->shootingLanguages = collect([]);
        if (! $this->fiche) {
            $this->isNew = true;
            $this->fiche = new Fiche;
            $this->movie = new Movie(Movie::defaultsMovie());
        } else {
            $this->movie = $this->fiche->movie;
            $this->shootingLanguages = collect($this->movie->languages->map(
                fn ($lang) => ['value' => $lang->id, 'label' => $lang->name],
            ));
            $this->producers = Producer::where('movie_id', $this->movie->id)->get()->toArray();
            $this->sales_agents = SalesAgent::where('movie_id', $this->movie->id)->get()->toArray();
        }

        if (Auth::user()->hasRole('applicant')) {
            $this->isApplicant = true;
        }
        if (Auth::user()->hasRole('editor')) {
            $this->isEditor = true;
        }

        if ($this->isApplicant && $this->isNew) {
            $this->fiche->status_id = 1;
        }

    }

    public function addShootingLanguage($lang)
    {
        // @todo build listener names using select name
        $this->shootingLanguages->push($lang[1]);
    }

    public function removeShootingLanguage($lang)
    {
        $this->shootingLanguages = $this->shootingLanguages->reject(
            fn ($shootingLanguage) => $shootingLanguage['value'] === $lang[1]['value']
        );
    }

    public function reject()
    {
        $this->fiche = new Fiche;
        $this->movie = new Movie;
    }

    public function submit()
    {
        $this->movie->shooting_language = $this->shootingLanguages;
        $this->validate();
        unset($this->movie->shooting_language);
        if ($this->movie->country_of_origin_points == '') $this->movie->country_of_origin_points = null;
        if ($this->isNew) {
            $this->movie->save();
            $this->movie->languages()->sync(
                $this->shootingLanguages->map(
                    fn ($lang) => $lang['value']
                )
            );
            $this->fiche->fill([
                'movie_id' => $this->movie->id,
                'dossier_id' => $this->dossier->id,
                'activity_id' => $this->activity->id,
                'created_by' => 1,
            ])->save();
            $this->emit('notify-saved');
        } else {
            // When editing
            $this->movie->save();
            $this->movie->languages()->sync(
                $this->shootingLanguages->map(
                    fn ($lang) => $lang['value']
                )
            );
            $this->fiche->save();
            $this->emit('notify-saved');
        }

        // producers, sales agents
        $this->saveItems(Producer::where('movie_id', $this->movie->id)->get(), $this->producers, Producer::class);
        $this->saveItems(SalesAgent::where('movie_id', $this->movie->id)->get(), $this->sales_agents, SalesAgent::class);

        // if ($this->dossier->call_id && $this->dossier->project_ref_id) {
        //     return redirect()->route('projects.create', ['call_id' => $this->dossier->call_id, 'project_ref_id' => $this->dossier->project_ref_id]);
        // }
    }

    public function updateMovieProducers($items)
    {
        $this->producers = $items;
    }

    public function updateMovieSalesAgents($items)
    {
        $this->sales_agents = $items;
    }

    public function saveItems($existing_items, $saving_items, $saving_class)
    {
        // delete first
        foreach($existing_items as $existing_item) {
            $missing = true;
            foreach($saving_items as $item) {
                if (isset($item['id'])) {
                    if ($existing_item->id == $item['id']) {
                        $missing = false;
                    }
                }
            }
            if ($missing) {
                if ($saving_class=='person_crew') {
                    Person::find($existing_item->person_id)->delete();
                    $existing_item->delete();
                } else {
                    $existing_item->delete();
                }
            }
        }
        // create/update
        foreach ($saving_items as $item) {
            unset($item['key']);
            unset($item['created_at']);
            unset($item['updated_at']);
            $item['movie_id'] = $this->movie->id;
            if (isset($item['id'])) {
                if ($saving_class == 'person_crew') {
                    // TODO: is there an 'update with' thing?
                    Crew::find($item['id'])->update($item);
                    Person::find($item['person_id'])->update($item['person']);
                } else {
                    $saving_class::find($item['id'])->update($item);
                }
            } else {
                if ($saving_class == 'person_crew') {
                    // TODO: is there an 'create with' thing?
                    $person = Person::create($item['person']);
                    Crew::create($item + ['person_id' => $person->id]);
                } else {
                    $saving_class::create($item);
                }
            }
        }
    }

    public function render()
    {
        if($this->getErrorBag()->any()){
            $this->emit('validation-errors');
        }

        return view('livewire.movie-dev-previous-form')
            ->layout('components.layout');
    }

}
