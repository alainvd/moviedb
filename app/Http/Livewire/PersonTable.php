<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Movie;
use App\Person;
use App\Crew;
use Illuminate\Support\Str;

class PersonTable extends Component
{

    public $movie_id = null;

    public $backoffice = false;

    // While editing people, we store a copy of all people in a local array.
    // We also convert each person in to array (there were issues otherwise).
    // TODO: or we could store people in People models, just not save them?
    public $peopleOnForm = [];

    // When to show modal
    public $showingEditModal = false;

    // While editing, person has to be a Model, for Livewire to wire it's fields.
    public Person $personEditing;

    // When to show modal
    public $showingDeleteModal = false;

    // Which person to delete
    public $deletePersonKey = null;

    protected $listeners = ['save-movie-details' => 'saveMoviePeople'];

    /**
     * Find person in the array
     */
    private function findPersonOnFormByKey($key)
    {
        $findPerson = array_filter(
            $this->peopleOnForm,
            function($a) use ($key) {
                if ($a['key'] == $key) return $a;
            }
        );
        if (empty($findPerson)) {
            return false;
        }
        return $findPerson;
    }

    /**
     * Find person in the array
     */
    private function findPersonOnFormById($id)
    {
        $findPerson = array_filter(
            $this->peopleOnForm,
            function($a) use ($id) {
                if ($a['id'] == $id) return $a;
            }
        );
        if (empty($findPerson)) {
            return false;
        }
        return $findPerson;
    }


    /**
     * Default values for Person form
     * Livewire needs these to be initialised of fields will be null
     */
    private function personDefaults()
    {
        return [
            // 'role' => 'actor',
            'firstname' => '',
            'lastname' => '',
            'gender' => 'male',
            'nationality1' => 'belgian',
            'nationality2' => '',
            'country_of_residence' => '',
        ];
    }

    /**
     * Each wired fields needs to be here or it will be filtered
     */
    protected $rules = [
        'personEditing.id' => '',
        'personEditing.key' => '',
        // 'personEditing.role' => 'required|string|max:255',
        'personEditing.firstname' => 'required|string|max:255|min:3',
        'personEditing.lastname' => 'required|string|max:255',
        'personEditing.gender' => 'required|string|max:255',
        'personEditing.nationality1' => 'required|string|max:255',
        'personEditing.nationality2' => 'string|max:255',
        'personEditing.country_of_residence' => 'string|max:255',
    ];

    /**
     * For nicer validation messages
     */
    protected $validationAttributes = [
        'personEditing.id' => 'id',
        'personEditing.key' => 'key',
        // 'personEditing.role' => 'role',
        'personEditing.firstname' => 'first name',
        'personEditing.lastname' => 'last name',
        'personEditing.gender' => 'gender',
        'personEditing.nationality1' => 'nationality 1',
        'personEditing.nationality2' => 'nationality 2',
        'personEditing.country_of_residence' => 'residence country',
    ];

    public function mount($movie_id = null, $backoffice = false)
    {
        $this->backoffice = $backoffice;
        if ($movie_id) {
            $this->movie_id = $movie_id;
            // Make a copy of people in array (TODO: change to collection?)
            $this->peopleOnForm = Movie::where('id', $this->movie_id)->first()->people->toArray();
            $this->peopleOnForm = array_map(
                function ($a) {
                    $a['key'] = Str::random(10);
                    return $a;
                },
                $this->peopleOnForm
            );
            // dd($this->peopleOnForm);
        } else {
            $this->peopleOnForm = [];
        };
    }

    public function render()
    {
        return view('livewire.person-table', ['movie_id'=>$this->movie_id]);
    }

    /**
     * Editing person modal
     */
    public function showModalEdit($key)
    {
        // NOTES: Convert to model, because Livewire can only wire Model properties

        // Just take the data from array and convert to People model
        $personEditing = $this->findPersonOnFormByKey($key);
        $personEditing = array_shift($personEditing);
        $this->personEditing = new Person($personEditing);

        $this->showingEditModal = true;
    }

    /**
     * New person modal
     */
    public function showModalAdd() {
        // Create a new empty person with unique key
        $this->personEditing = new Person($this->personDefaults());
        $this->personEditing['key'] = Str::random(10);

        $this->resetValidation();
        $this->showingEditModal = true;
    }

    /**
     * Save person locally
     */
    public function savePerson()
    {
        $this->validate();
        $this->showingEditModal = false;

        // For Livewire purposes, this is a Model
        // save to the array, with unique id
        $personEditing = $this->personEditing->toArray();
        
        // find by key - update or add
        $findPerson = $this->findPersonOnFormByKey($personEditing['key']);
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
     * Delete person from local array
     */
    public function deletePerson() {
        $findPerson = $this->findPersonOnFormByKey($this->deletePersonKey);
        if ($findPerson) {
            unset($this->peopleOnForm[array_key_first($findPerson)]);
        }
        $this->showingDeleteModal = false;
    }

    /**
     * Save people changes to database
     */
    public function saveMoviePeople(Movie $movie)
    {
        // (Everything is an array at this point)
        // TODO: somehow mark which need to be updated
        foreach ($this->peopleOnForm as $index => $person) {
            // Save new person
            if (!isset($person['id'])) {
                $person_save  = $person;
                $person_key = $person_save['key'];
                unset($person_save['key']);
                // TODO: fix points, fix title
                $points = 10;
                $title_id = 10;
                $person_saved = $movie->addPerson($person_save, $points, $title_id, $movie->id);
                $person_saved_array = $person_saved->toArray();
                $person_saved_array['key'] = $person_key;
                $this->peopleOnForm[$index] = $person_saved_array;
            }
            // Update existing person
            else {
                $person_save  = $person;
                unset($person_save['key']);
                unset($person_save['laravel_through_key']);
                unset($person_save['created_at']); // TODO
                unset($person_save['updated_at']); // TODO
                Person::where('id', $person_save['id'])->update($person_save);
            }
        }

        // Remove people that have been deleted in the form
        foreach ($movie->people()->get() as $person) {
            if (!$this->findPersonOnFormById($person['id'])) {
                Person::where('id', $person['id'])->delete();
                Crew::where('person_id', $person['id'])->delete();
            }
        }
    }

}