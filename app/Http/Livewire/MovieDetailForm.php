<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Movie;
use App\Media;
use App\Models\Person;
use Illuminate\Support\Str;

class MovieDetailForm extends Component
{

    // Movie data for Livewire
    public Movie $movie;

    // While editing people, we store a copy of all people in a local array.
    // We also convert each person in to array (there were issues otherwise).
    // TODO: or we could store people in People models, just not save them?
    public $peopleOnForm;

    // When to show modal
    public $showingModal = false;

    // While editing person has to be a Model, for Livewire to wire it's fields.
    // TODO: or we can have property for each field.
    public Person $personEditing;

    /**
     * Each wired fields needs to be here or it will be filtered
     */
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
        
        'personEditing.id' => '',
        'personEditing.key' => '',
        'personEditing.first_name' => 'string|max:255',
        'personEditing.last_name' => 'string|max:255',
    ];

    public function mount($movie_id = null)
    {
        if ($movie_id) {
            $this->movie = Movie::where('id', $movie_id)->first();
            // Make a copy of people in array (TODO: change to collection?)
            $this->peopleOnForm = $this->movie->people->toArray();
            $this->peopleOnForm = array_map(
                function ($a) {
                    $a['key'] = Str::random(10);
                    return $a;
                },
                $this->peopleOnForm
            );
        } else {
            $this->movie = new Movie;
            $this->peopleOnForm = [];
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

        // (Everything is an array at this point)
        // TODO: somehow mark which need to be updated
        foreach ($this->peopleOnForm as $person) {
            // Save new people
            if (!isset($person['id'])) {
                unset($person['key']);
                $this->movie->people()->create($person);
            }
            // Update existing people
            else {
                unset($person['key']);
                unset($person['created_at']);
                unset($person['updated_at']);
                Person::where('id', $person['id'])->update($person);
            }
        }
    }

    /**
     * Editing person modal
     */
    public function showModalEdit($key = null)
    {
        // NOTES: Convert to model, because Livewire can only wire Model properties
        // TODO: or I can create property for each field?

        // Just take the data from array and convert to People model
        $personEditing = array_filter(
            $this->peopleOnForm,
            function($a) use ($key) {
                if ($a['key'] == $key) return $a;
            }
        );
        $personEditing = array_shift($personEditing);
        $this->personEditing = new Person($personEditing);

        $this->showingModal = true;
    }

    /**
     * New person modal
     */
    public function showModalNew() {
        $this->personEditing = new Person;

        $this->showingModal = true;
    }

    /**
     * Save person locally
     */
    public function savePerson()
    {
        $this->showingModal = false;

        // For Livewire purposes, this is a Model
        // save to the array, with unique id
        $personEditing = $this->personEditing->toArray();
        $personEditing['type'] = 'crew';
        $personEditing['role'] = 'director';
        $personEditing['gender'] = 'Male';
        $personEditing['nationality1'] = 'Belgium';
        $personEditing['country_of_residence'] = 'Belgium';

        // find by key - update or add
        $findPerson = array_filter(
            $this->peopleOnForm,
            function($a) use ($personEditing) {
                if ($a['key'] == $personEditing['key']) return $a;
            }
        );
        if ($findPerson) {
            $findPersonKey = array_key_first($findPerson);
            $this->peopleOnForm[$findPersonKey] = $personEditing;
        }
        else {
            $this->peopleOnForm[] = $personEditing;
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
