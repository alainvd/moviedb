<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Movie;
use App\Media;
use App\Models\Person;
use Illuminate\Database\Eloquent\Collection;

class MovieDetailForm extends Component
{

    public Movie $movie;
    public $peopleOnForm;
    public $showingModal = false;
    public Person $personEditing;

    protected $rules = [
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
        
        'personEditing.first_name' => 'string|max:255',
        'personEditing.last_name' => 'string|max:255',
    ];

    public function mount($movie_id = null)
    {
        if ($movie_id) {
            $this->movie = Movie::where('id', $movie_id)->first();
            $this->peopleOnForm = $this->movie->people;
        } else {
            $this->movie = new Movie;
            // This has to be Eloquent Collection.
            // If simple Collection or array, Livewire does not preserve models inside, turns them into arrays.
            $this->peopleOnForm = new \Illuminate\Database\Eloquent\Collection;
        };
    }

    public function save()
    {
        $this->validate();
        // TODO: notify about validation errors (get stuff from Surge modal form)
        if (!$this->movie->exists) {
            $this->saveMovie();
            return redirect()->to('/movie/detail/' . $this->movie->id);            
        } else {
            $this->saveMovie();
            $this->emitSelf('notify-saved');
        }
    }

    /**
     * Save new or existing movie and people
     */
    private function saveMovie()
    {
        $this->movie->save();

        foreach ($this->peopleOnForm as $person) {
            $person->media_id = $this->movie->id;
            $person->save();
        }
    }

    public function showModal($id = null)
    {
        if ($id) {
            $this->personEditing = Person::where('id', $id)->first();
        } else {
            $this->personEditing = new Person;
        }

        $this->showingModal = true;
    }

    public function savePerson()
    {
        $this->showingModal = false;

        if ($this->personEditing->id) {
            $this->personEditing->save();
            // Reflect changed person in peopleOnForm
            // TODO: there must be a better way
            $ppp = $this->peopleOnForm->where('id', $this->personEditing->id)->first();
            $ppp->first_name = $this->personEditing->first_name;
            $ppp->last_name = $this->personEditing->last_name;
        } else {
            // TODO: details
            $this->personEditing->type = 'crew';
            $this->personEditing->role = 'director';
            $this->personEditing->gender = 'Male';
            $this->personEditing->nationality1 = 'Belgium';
            $this->personEditing->country_of_residence = 'Belgium';

            // NOTE 1:
            // While editing people, we store them in a Collection.
            // Livewire properties can store Collection and EloquentCollection
            // (but not array):
            // https://laravel-livewire.com/docs/2.x/properties#important-notes:~:text=Properties%20can%20ONLY%20be%20either%20JavaScript
            
            // NOTE 2:
            // We want to store unsaved people (with Person model) while editing movie form
            // But Laravel/Tailwind doesn't like to work with unsaved Models
            // So we're saving people without media_id reference, until the whole movie is saved.

            // TODO:
            // There is still an issue of EDITING people, which are already stored to media.
            // There are always updated, regardless if we save the movie.
            // E.g. When starting to edit, People has to be a true copy (detached from database).
            // And only save them, when saving whole movie.

            // TODO:
            // Same situation with removing people

            $this->personEditing->save();
            $this->peopleOnForm->push($this->personEditing);
        }
    }

    public function render()
    {
        return view('livewire.movie-detail-form', [
            'languages'=>Media::LANGUAGES,
            'years'=>Media::YEARS(),
            'genres'=>Media::GENRES,
            'countries'=>Media::COUNTRIES,
        ]);
    }
}
