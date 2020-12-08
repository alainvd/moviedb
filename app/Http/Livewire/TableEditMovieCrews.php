<?php

namespace App\Http\Livewire;

use App\Movie;
use App\Title;
use App\Crew;
use App\Person;
use App\Models\Country;

class TableEditMovieCrews extends TableEditBase
{

    public Movie $movie;

    public $backoffice = false;

    public $titles = [];

    public $genders = [];

    public $countries = [];

    public $points_total = 0;

    protected function defaults()
    {
        return [
            'points' => 0,
            'title_id' => Title::first()->id,
            'person' => [
                'firstname' => '',
                'lastname' => '',
                'gender' => array_key_first($this->genders),
                'nationality1' => 'belgian',
                'nationality2' => '',
                'country_of_residence' => '',
            ],
        ] + parent::defaults();
    }

    protected function rules()
    {
        return [
            'editing.points' => '',
            'editing.title_id' => 'required',
            'editing.person.firstname' => 'required|string|max:255',
            'editing.person.lastname' => 'required|string|max:255',
            'editing.person.gender' => 'required|string|max:255',
            'editing.person.nationality1' => 'required|string|max:255',
            'editing.person.nationality2' => 'string|max:255',
            'editing.person.country_of_residence' => 'string|max:255',
        ] + parent::rules();
    }

    protected function validationAttributes()
    {
        return [
            'editing.title_id' => 'title',

            'editing.person.firstname' => 'first name',
            'editing.person.lastname' => 'last name',
            'editing.person.gender' => 'gender',
            'editing.person.nationality1' => 'nationality 1',
            'editing.person.nationality2' => 'nationality 2',
            'editing.person.country_of_residence' => 'residence country',

            // 'editing.media_id' => 'media_id',
        ] + parent::validationAttributes();
    }

    private function load()
    {
        // Get people related to media:
        // Crew with person
        $this->items = Crew::with('person')->where('media_id',$this->movie->media->id)->get()->toArray();
        $this->addUniqueKeys();
    }

    public function mount($movie_id = null, $backoffice = false)
    {
        $this->titles = Title::all()->keyBy('id')->toArray();
        $this->genders = Person::GENDERS;
        $this->countries = ['' => ['code' => '', 'name' => '']] + Country::all()->keyBy('code')->toArray();
        if ($movie_id) {
            $this->movie = Movie::find($movie_id);
            $this->load();
        }
        $this->backoffice = $backoffice;
        array_map(
            function ($a) {
                $this->points_total += $a['points'];
            },
            $this->items
        );
    }

    public function render()
    {
        return view('livewire.table-edit-movie-crews');
    }

    protected function sendItems()
    {
        $this->emitUp('update-movie-crews', $this->items);
    }

    public function pointsDec($key) {
        $findPerson = $this->findItemByKey($key);
        if ($findPerson) {
            $this->items[array_key_first($findPerson)]['points']--;
            $this->points_total--;
        }

        $this->sendItems();
    }

    public function pointsInc($key) {
        $findPerson = $this->findItemByKey($key);
        if ($findPerson) {
            $this->items[array_key_first($findPerson)]['points']++;
            $this->points_total++;
        }

        $this->sendItems();
    }

    public function deleteItem() {
        $findPerson = $this->findItemByKey($this->deleteItemKey);
        if ($findPerson) {
            $personFound = $this->items[array_key_first($findPerson)];
            $this->points_total -= $personFound['points'];
        }
        parent::deleteItem();
    }

}
