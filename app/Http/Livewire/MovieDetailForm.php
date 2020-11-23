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
    public $showingEditModal = false;

    // While editing person has to be a Model, for Livewire to wire it's fields.
    // TODO: or we can have property for each field.
    public Person $personEditing;

    // When to show modal
    public $showingDeleteModal = false;

    // Which person to delete
    public $deletePersonKey;

    /**
     * Find person in the array
     */
    private function findPersonOnForm($key)
    {
        $findPerson = array_filter(
            $this->peopleOnForm,
            function($a) use ($key) {
                if ($a['key'] == $key) return $a;
            }
        );
        return $findPerson;
    }

    /**
     * Each wired fields needs to be here or it will be filtered
     */
    protected $rules = [
        'movie.original_title' => 'required|string|max:255|min:3',
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
        'personEditing.type' => 'string|max:255',
        'personEditing.role' => 'string|max:255',
        'personEditing.first_name' => 'required|string|max:255|min:3',
        'personEditing.last_name' => 'string|max:255',
        'personEditing.gender' => 'string|max:255',
        'personEditing.nationality1' => 'string|max:255',
        'personEditing.nationality2' => 'string|max:255',
        'personEditing.country_of_residence' => 'string|max:255',
    ];

    protected $validationAttributes = [
        'personEditing.first_name' => 'first name'
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
    public function showModalEdit($key)
    {
        // NOTES: Convert to model, because Livewire can only wire Model properties
        // TODO: or I can create property for each field?

        // Just take the data from array and convert to People model
        $personEditing = $this->findPersonOnForm($key);
        $personEditing = array_shift($personEditing);
        $this->personEditing = new Person($personEditing);

        $this->showingEditModal = true;
    }

    /**
     * New person modal
     */
    public function showModalAdd() {
        // Create a new empty person
        // Add unique key
        $this->personEditing = new Person;
        $this->personEditing['key'] = Str::random(10);

        $this->showingEditModal = true;
    }

    /**
     * Save person locally
     */
    public function savePerson()
    {
        $validatedData = $this->validate();
        $this->showingEditModal = false;

        // For Livewire purposes, this is a Model
        // save to the array, with unique id
        $personEditing = $this->personEditing->toArray();
        
        // find by key - update or add
        $findPerson = $this->findPersonOnForm($personEditing['key']);
        if ($findPerson) {
            $findPersonKey = array_key_first($findPerson);
            $this->peopleOnForm[$findPersonKey] = $personEditing;
        }
        else {
            $this->peopleOnForm[] = $personEditing;
        }
    }

    /**
     * When deleting
     */
    public function showModalDelete($key) {
        $this->showingDeleteModal = true;
        $this->deletePersonKey = $key;
    }

    /**
     * Delete person
     */
    public function deletePerson() {
        $findPerson = $this->findPersonOnForm($this->deletePersonKey);
        if ($findPerson) {
            unset($this->peopleOnForm[array_key_first($findPerson)]);
        }
        $this->showingDeleteModal = false;
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
