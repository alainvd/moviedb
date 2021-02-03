<?php

namespace App\Http\Livewire;

use App\Crew;
use App\Genre;
use App\Media;
use App\Movie;
use App\Title;
use App\Person;
use App\Dossier;
use App\Audience;
use App\Document;
use App\Producer;
use App\SalesAgent;
use App\Models\Fiche;
use App\Models\Country;
use Livewire\Component;
use App\Models\Activity;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class MovieDistForm extends Component
{

    public $isNew = false;
    public $isApplicant = false;
    public $isEditor = false;

    // Movie data for Livewire
    public Dossier $dossier;
    public Activity $activity;
    public ?Fiche $fiche = null;
    public ?Movie $movie = null;
    public ?Media $media = null;

    public $movie_original = [];

    public $shootingLanguages;

    public $crews = [];
    public $producers = [];
    public $sales_agents = [];
    public $documents = [];

    protected $listeners = [
        'update-movie-crews' => 'updateMovieCrews',
        'update-movie-producers' => 'updateMovieProducers',
        'update-movie-sales-agents' => 'updateMovieSalesAgents',
        'update-movie-documents' => 'updateMovieDocuments',
        'addItem' => 'addShootingLanguage',
        'removeItem' => 'removeShootingLanguage'
    ];

    protected $rulesApplicant = [
        'movie.original_title' => 'required|string|max:255',
        'fiche.status_id' => 'required|integer',
        'movie.film_country_of_origin' => 'string',
        'movie.year_of_copyright' => 'integer',
        'media.genre_id' => 'required|integer',
        'media.delivery_platform_id' => 'required|integer',
        'media.audience_id' => 'required|integer',
        'movie.film_type' => 'required|string',

        'movie.imdb_url' => 'string|max:255',
        'movie.isan' => 'string|max:255',
        'movie.synopsis' => 'string',

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
        'movie.year_of_copyright' => 'integer',
        'media.genre_id' => 'required|integer',
        'media.delivery_platform_id' => 'required|integer',
        'media.audience_id' => 'required|integer',
        'movie.film_type' => 'required|string',

        'movie.imdb_url' => 'string|max:255',
        'movie.isan' => 'string|max:255',
        'movie.synopsis' => 'string',

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

    protected function validateMovieCrew() {
        // check for all crew members
        $requiredTitles = Title::whereIn('code', Crew::requiredMovieCrew())->get();
        $requiredCrewMessages = [];
        foreach ($requiredTitles as $title) {
            if (!array_filter(
                $this->crews,
                function ($crew) use ($title) {
                    return $crew['title_id'] == $title->id;
                }
            ))
            {
                $requiredCrewMessages[] = 'Required crew member: ' . $title->name;
            }
        }
        // check for all crew person fields
        $requiredPersonFieldMessages = [];
        foreach ($this->crews as $crew) {
            $req = new Request($crew);
            $movieCrews = new TableEditMovieCrews();
            try{
                $req->validate($movieCrews->crewRules($this->isEditor));
            }
            catch (ValidationException $e){
                $requiredPersonFieldMessages[] = 'Crew member is missing required fields: ' . Title::find($crew['title_id'])->name;
            }
        }
        if (!empty($requiredCrewMessages) || !empty($requiredPersonFieldMessages) ) {
            return array_merge($requiredCrewMessages,$requiredPersonFieldMessages);
        }
        return true;
    }

    protected function validateDocumentsFinancingPlan() {
        // check if financing plan document is present
        foreach ($this->documents as $document) {
            if ($document['document_type'] == 'FINANCING') return true;
        }
        return false;
    }

    public function callValidate()
    {
        $this->movie->shooting_language = $this->shootingLanguages;
        $this->validate();
        unset($this->movie->shooting_language);
        if (!$this->validateDocumentsFinancingPlan()) {
            $this->emit('filesErrorMessage', 'Film financing plan is required.');
        } else {
            $this->emit('filesErrorMessage', null);
        }
        $validateMovieCrew = $this->validateMovieCrew();
        if ($validateMovieCrew !== true) {
            $this->emit('crewErrorMessages', $validateMovieCrew);
        } else {
            $this->emit('crewErrorMessages', null);
        }
    }

    protected function movieDefaults() {
        return [
            'total_budget_currency_code' => 'EUR',
        ];
    }

    public function mount(Request $request)
    {
        $this->shootingLanguages = collect([]);
        if (! $this->fiche) {
            $this->isNew = true;
            $this->fiche = new Fiche;
            $this->media = new Media;
            $this->movie = new Movie($this->movieDefaults());
            $this->crews = Crew::newMovieCrew();
        } else {
            $this->media = $this->fiche->media;
            $this->movie = $this->media->grantable;
            $this->shootingLanguages = collect($this->movie->languages->map(
                fn ($lang) => ['value' => $lang->id, 'label' => $lang->name],
            ));
            $this->crews = Crew::with('person')->where('media_id',$this->movie->media->id)->get()->toArray();
            $this->producers = Producer::where('media_id', $this->movie->media->id)->get()->toArray();
            $this->sales_agents = SalesAgent::where('media_id', $this->movie->media->id)->get()->toArray();
            $this->documents = Document::where('media_id', $this->movie->media->id)->get()->toArray();
        }

        if (Auth::user()->hasRole('applicant')) {
            $this->isApplicant = true;
        }
        if (Auth::user()->hasRole('editor')) {
            $this->isEditor = true;
        }

        if($request->input('editor')) {
            $this->isApplicant = false;
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
        $this->media = new Media;
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
            $media_store = $this->media;
            $this->media = $this->movie->media;
            $this->media->fill([
                'title' => $this->movie->original_title,
                'audience_id' => $media_store->audience_id,
                'genre_id' => $media_store->genre_id,
                'grantable_id' => $this->movie->id,
                'delivery_platform_id' => $media_store->delivery_platform_id,
                'grantable_type' => 'App\Movie',
            ])->save();
            $this->fiche->fill([
                'media_id' => $this->media->id,
                'dossier_id' => $this->dossier->id,
                'activity_id' => $this->activity->id,
                'created_by' => 1,
            ])->save();
            $this->emit('notify-saved');
        } else {
            // When saving existing fiche
            $this->movie->save();
            $this->movie->languages()->sync(
                $this->shootingLanguages->map(
                    fn ($lang) => $lang['value']
                )
            );
            $this->media->title = $this->movie->original_title;
            $this->media->save();
            $this->fiche->save();
            $this->emit('notify-saved');
        }

        // crew, producers, sales agents, documents
        $this->saveItems(Crew::with('person')->where('media_id',$this->movie->media->id)->get(), $this->crews, 'person_crew');
        $this->saveItems(Producer::where('media_id', $this->movie->media->id)->get(), $this->producers, Producer::class);
        $this->saveItems(SalesAgent::where('media_id', $this->movie->media->id)->get(), $this->sales_agents, SalesAgent::class);
        $this->saveItems(Document::where('media_id', $this->movie->media->id)->get(), $this->documents, Document::class);

        // if ($this->dossier->call_id && $this->dossier->project_ref_id) {
        //     return redirect()->route('projects.create', ['call_id' => $this->dossier->call_id, 'project_ref_id' => $this->dossier->project_ref_id]);
        // }
    }

    public function updateMovieCrews($items)
    {
        $this->crews = $items;
    }

    public function updateMovieProducers($items)
    {
        $this->producers = $items;
    }

    public function updateMovieSalesAgents($items)
    {
        $this->sales_agents = $items;
    }

    public function updateMovieDocuments($items)
    {
        $this->documents = $items;
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
            $item['media_id'] = $this->movie->media->id;
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

        $title = 'Films - Distribution';
        $crumbs[] = [
            'url' => route('dossiers'),
            'title' => 'My dossiers'
        ];
        $crumbs[] = [
            'url' => route('dossiers'),
            'title' => 'Edit dossier'
        ];
        $crumbs[] = [
            'title' => 'Edit fiche'
        ];

        if ($this->isApplicant) {
            return view('livewire.movie-dist-form')
                ->layout('components.ecl-layout', ['title' => $title, 'crumbs' => $crumbs]);
        } else {
            return view('livewire.movie-dist-form')
                ->layout('components.layout', ['title' => $title, 'crumbs' => $crumbs]);
        }
    }

}
