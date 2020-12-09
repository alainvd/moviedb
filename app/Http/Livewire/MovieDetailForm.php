<?php

namespace App\Http\Livewire;

use App\Audience;
use App\Crew;
use App\Dossier;
use App\Genre;
use Livewire\Component;
use App\Movie;
use App\Media;
use App\Models\Country;
use App\Models\Fiche;
use App\Models\Language;
use App\Person;
use App\Producer;
use App\SalesAgent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class MovieDetailForm extends Component
{

    // Fake field
    // public $form_update_unique = 0;

    public $isNew = false;
    public $isApplicant = false;

    // Movie data for Livewire
    public ?Fiche $fiche = null;
    public ?Movie $movie = null;
    public ?Media $media = null;

    // Movie original
    public $movie_original = [];

    // Allow special editing
    public $backoffice = false;

    public $crews = [];
    public $producers = [];
    public $sales_agents = [];

    protected $listeners = [
        'movie-details-force-submit' => 'formSubmitForce',
        'update-movie-crews' => 'updateMovieCrews',
        'update-movie-producers' => 'updateMovieProducers',
        'update-movie-sales-agents' => 'updateMovieSalesAgents',
    ];

    /**
     * Each wired fields needs to be here or it will be filtered
     */
    protected $rules = [
        // 'form_update_unique' => 'required',
        'movie.original_title' => 'required|string|max:255',
        'fiche.status_id' => 'required|string|max:255',
        'movie.film_country_of_origin' => 'required|string|max:255',
        'movie.year_of_copyright' => 'required|integer',
        'movie.film_type' => 'required|string|max:255',
        'movie.imdb_url' => 'required|string|max:255',
        // 'movie.shooting_start' => 'required|date',
        // 'movie.shooting_end' => 'required|date',
        'movie.film_length' => 'required|string|max:255',
        'movie.film_format' => 'required|string|max:255',
        'movie.isan' => 'required|string',
        'movie.synopsis' => 'required|string',
        'movie.photography_start' => 'required|date',
        'movie.photography_end' => 'date',

        'media.audience_id' => 'required',
        'media.genre_id' => 'required',
        'media.delivery_platform_id' => 'required|integer',
    ];

    public function mount()
    {
        if (! $this->fiche) {
            $this->isNew = true;
            $this->fiche = new Fiche;
            $this->media = new Media;
            $this->movie = new Movie;
        } else {
            $this->media = $this->fiche->media;
            $this->movie = $this->media->grantable;
        }

        // @TODO use role here after fixing hydration issue for masquerade user
        if (Auth::user() === 'mediadb-applicant') {
            $this->isApplicant = true;
        }

        // $this->backoffice = Auth::user()->eu_login_username === 'mediadb-editor';
    }

    // public function formSubmitForce()
    // {
    //     $this->form_update_unique = rand(0, 9999);
    // }

    public function submit()
    {
        $this->validate();

        // When it's new
        if ($this->isNew) {
            // Save movie
            $this->movie->save();
            // Save media
            // @question is the title here really necessary + required?
            $this->media->title = $this->movie->original_title;
            $this->media->grantable_id = $this->movie->id;
            $this->media->grantable_type = 'App\Movie';
            $this->media->save();
            // Save fiche
            $this->fiche->media_id = $this->media->id;
            $this->fiche->created_by = Auth::user()->id;
            $this->fiche->save();
            // Create dossier and assign
            $dossier = Dossier::create([
                'project_ref_id' => 'someref',
                'action' => 'DIST',
                'status_id' => $this->fiche->status_id,
                'year' => date('Y'),
                'call_id' => 1
            ]);
            $dossier->media()->save($this->media);
        } else { // When editing
            $this->movie->save();
            $this->movie->media->save();
            $this->media->fiche->save();
            $this->media->dossier->save();
        }

        // Saving
        // $_movie_create_form = !$this->movie->exists;
        // $this->saveMovieDetails();
        // $this->emitSelf('notify-saved');

        // if ($_movie_create_form) {
        //     // Can't redirect while people are still being saved
        //     //return redirect()->to('/movie/detail/' . $this->movie->id);
        //     // TODO: tell browser to update the url
        //     // window.history.pushState('page2', 'Title', '/page2.php');
        // }
    }

    /**
     * Save new or existing movie and people
     */
    private function saveMovieDetails()
    {
        // create media, create movie
        if (!$this->movie->exists) {
            $this->movie->save();
            $media = [
                'title' => $this->movie->original_title,
                'audience_id' => Audience::first()->id,
                'genre_id' => Genre::first()->id,
                'grantable_id' => $this->movie->id,
                'grantable_type' => 'App\Movie'
            ];
            $media = Media::create($media);
        } else {
            $this->movie->save();
        }
        $this->movie_original = $this->movie->getOriginal();
        // cast/crew (old approach)
        $this->emit('save-movie-details', $this->movie->id);
        // crew, producers, sales agents (new approach)
        $this->saveItems(Crew::with('person')->where('media_id',$this->movie->media->id)->get(), $this->crews, 'person_crew');
        $this->saveItems(Producer::where('media_id', $this->movie->media->id)->get(), $this->producers, Producer::class);
        $this->saveItems(SalesAgent::where('media_id', $this->movie->media->id)->get(), $this->sales_agents, SalesAgent::class);
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
        return view('livewire.movie-detail-form')
            ->layout('components.layout');
    }

}
