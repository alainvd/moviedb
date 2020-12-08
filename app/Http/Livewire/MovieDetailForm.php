<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Movie;
use App\Media;
use App\Audience;
use App\Genre;
use App\Person;
use App\Crew;
use App\Producer;
use App\SalesAgent;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class MovieDetailForm extends Component
{

    // Fake field
    public $form_update_unique = 0;

    // Movie data for Livewire
    public Movie $movie;

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
        'form_update_unique' => 'required',
        'movie.original_title' => 'required|string|max:255',
        'movie.european_nationality_flag' => 'string|max:255',
        'movie.film_country_of_origin' => 'string|max:255',
        'movie.year_of_copyright' => 'integer',
        'movie.film_type' => 'string|max:255',
        'movie.imdb_url' => 'string|max:255',
        // 'movie.shooting_start' => 'date_format:d/m/Y',
        'movie.shooting_start' => 'date',
        // 'movie.shooting_end' => 'date_format:d/m/Y',
        'movie.shooting_end' => 'date',
        'movie.film_length' => 'string|max:255',
        'movie.film_format' => 'string|max:255',
    ];

    public function mount($movie_id = null, $backoffice = false)
    {
        if ($movie_id) {
            $this->movie = Movie::find($movie_id);
            $this->producers = Crew::with('person')->where('media_id',$this->movie->media->id)->get()->toArray();
            $this->producers = Producer::where('media_id', $this->movie->media->id)->get()->toArray();
            $this->sales_agents = SalesAgent::where('media_id', $this->movie->media->id)->get()->toArray();
        } else {
            $this->movie = new Movie;
        };
        $this->movie_original = $this->movie->getOriginal();
    }

    public function render()
    {
    }

    public function formSubmitForce()
    {
        $this->form_update_unique = rand(0, 9999);
    }

    public function save()
    {
        // TODO: notify about validation errors (get stuff from Surge modal form)
        $this->validate();

        // Saving
        $_movie_create_form = !$this->movie->exists;
        $this->saveMovieDetails();
        $this->emitSelf('notify-saved');

        if ($_movie_create_form) {
            // Can't redirect while people are still being saved
            //return redirect()->to('/movie/detail/' . $this->movie->id);
            // TODO: tell browser to update the url
            // window.history.pushState('page2', 'Title', '/page2.php');
        }
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

}
