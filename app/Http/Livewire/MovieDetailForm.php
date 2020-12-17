<?php

namespace App\Http\Livewire;

use App\Audience;
use App\Crew;
use App\Dossier;
use App\Genre;
use Livewire\Component;
use App\Movie;
use App\Media;
use App\Models\Activity;
use App\Models\Country;
use App\Models\Fiche;
use App\Models\Language;
use App\Person;
use App\Producer;
use App\SalesAgent;
use Illuminate\Support\Facades\Auth;


class MovieDetailForm extends Component
{

    public $isNew = false;
    public $isApplicant = false;

    // Movie data for Livewire
    public Dossier $dossier;
    public Activity $activity;
    public ?Fiche $fiche = null;
    public ?Movie $movie = null;
    public ?Media $media = null;

    // Movie original
    public $movie_original = [];

    // Allow special editing
    public $backoffice = false;

    // public $shootingLanguages;
    public $shootingLanguage = '';

    public $crews = [];
    public $producers = [];
    public $sales_agents = [];

    protected $listeners = [
        'update-movie-crews' => 'updateMovieCrews',
        'update-movie-producers' => 'updateMovieProducers',
        'update-movie-sales-agents' => 'updateMovieSalesAgents',
        'addItem' => 'addShootingLanguage',
        'removeItem' => 'removeShootingLanguage'
    ];

    /**
     * Each wired fields needs to be here or it will be filtered
     */
    protected $rules = [
        'shootingLanguage' => 'required|integer',
        'movie.original_title' => 'required|string|max:255',
        'fiche.status_id' => 'required|integer',
        'movie.film_country_of_origin' => 'string',
        'movie.country_of_origin_points' => 'numeric',
        'movie.year_of_copyright' => 'required|integer',
        'media.genre_id' => 'required|integer',
        'media.delivery_platform_id' => 'required|integer',
        'media.audience_id' => 'required|integer',
        'movie.film_type' => 'required|string|min:1|max:255',
        'movie.imdb_url' => 'string|max:255',
        'movie.photography_start' => 'required|date:d.m.Y',
        'movie.photography_end' => 'required|date:d.m.Y',
        'movie.film_length' => 'required|integer',
        'movie.film_format' => 'required|string|max:255',
        'movie.isan' => 'string',
        'movie.synopsis' => 'required|string',
        'movie.total_budget_currency_amount' => 'required|integer',
        'movie.total_budget_currency_code' => 'required|string',
        'movie.total_budget_currency_rate' => 'numeric',
        'movie.total_budget_euro' => 'integer',
        'fiche.comments' => 'string',
    ];

    protected function movieDefaults() {
        return [
            'total_budget_currency_code' => 'EUR',
            'country_of_origin_points' => 0,
        ];
    }

    public function mount()
    {
        // $this->shootingLanguages = collect([]);
        if (! $this->fiche) {
            $this->isNew = true;
            $this->fiche = new Fiche;
            $this->media = new Media;
            $this->movie = new Movie($this->movieDefaults());
        } else {
            $this->media = $this->fiche->media;
            $this->movie = $this->media->grantable;
            // Fill selected languages
            // $this->shootingLanguages = $this->movie->languages->map(
            //     fn ($lang) => ['value' => $lang->id, 'label' => $lang->name],
            // );

            $this->crews = Crew::with('person')->where('media_id',$this->movie->media->id)->get()->toArray();
            $this->producers = Producer::where('media_id', $this->movie->media->id)->get()->toArray();
            $this->sales_agents = SalesAgent::where('media_id', $this->movie->media->id)->get()->toArray();
        }

        // @TODO use role here after fixing hydration issue for masquerade user
        if (Auth::user()->eu_login_username === 'mediadb-applicant') {
            $this->isApplicant = true;
        }

        if ($this->isApplicant && $this->isNew) {
            $this->fiche->status_id = 1;
        }

        // $this->backoffice = Auth::user()->eu_login_username === 'mediadb-editor';
        $this->backoffice = true;
    }

    // public function addShootingLanguage($lang)
    // {
    //     // @todo build listener names using select name
    //     $this->shootingLanguages->push($lang[1]);
    // }

    // public function removeShootingLanguage($lang)
    // {
    //     $this->shootingLanguages = $this->shootingLanguages->reject(
    //         fn ($shootingLanguage) => $shootingLanguage['value'] === $lang[1]['value']
    //     );
    // }

    public function callValidate()
    {
        $this->validate();
    }

    public function reject()
    {
        $this->fiche = new Fiche;
        $this->media = new Media;
        $this->movie = new Movie;
    }

    public function submit()
    {
        $this->validate();

        // When it's new
        if ($this->isNew) {
            // Save movie
            $this->movie->save();
            $this->movie->languages()->attach(
                $this->shootingLanguage
            );

            // Save media
            $this->media->fill([
                'title' => $this->movie->original_title,
                'grantable_id' => $this->movie->id,
                'grantable_type' => 'App\Movie',
            ])->save();

            // Save fiche
            $this->fiche->fill([
                'media_id' => $this->media->id,
                'dossier_id' => $this->dossier->id,
                'activity_id' => $this->activity->id,
                'created_by' => 1,
            ])->save();

            $this->emit('notify-saved');
        } else { // When editing
            $this->movie->save();
            $this->movie->languages()->attach(
                // $this->shootingLanguages->map(
                //     fn ($lang) => $lang['value']
                // )
                $this->shootingLanguage
            );
            $this->media->title = $this->movie->original_title;
            $this->media->save();
            $this->fiche->save();
            $this->emit('notify-saved');
        }

        // crew, producers, sales agents
        $this->saveItems(Crew::with('person')->where('media_id',$this->movie->media->id)->get(), $this->crews, 'person_crew');
        $this->saveItems(Producer::where('media_id', $this->movie->media->id)->get(), $this->producers, Producer::class);
        $this->saveItems(SalesAgent::where('media_id', $this->movie->media->id)->get(), $this->sales_agents, SalesAgent::class);

        if ($this->dossier->call_id && $this->dossier->project_ref_id) {
            return redirect()->route('projects.create', ['call_id' => $this->dossier->call_id, 'project_ref_id' => $this->dossier->project_ref_id]);
        }
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

        return view('livewire.movie-detail-form')
            ->layout('components.layout');
    }

}
