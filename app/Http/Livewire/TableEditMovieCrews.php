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
    public $countries_by_key = [];

    public $points_total = 0;

    protected function defaults()
    {
        return [
            'editing.points' => null,
            'editing.person.nationality2' => null,
            'editing.person.country_of_residence' => null,
        ] + parent::defaults();
    }

    static function rules()
    {
        return [
            'editing.points' => 'required|numeric',
            'editing.title_id' => 'required',
            'editing.person.firstname' => 'required|string|max:255',
            'editing.person.lastname' => 'required|string|max:255',
            'editing.person.gender' => 'required|string|max:255',
            'editing.person.nationality1' => 'required|string|max:255',
            'editing.person.nationality2' => 'string|max:255',
            'editing.person.country_of_residence' => 'string|max:255',
        ] + TableEditBase::rules();
    }

    protected function validationAttributes()
    {
        return [
            'editing.points' => 'points',
            'editing.title_id' => 'title',
            'editing.person.firstname' => 'first name',
            'editing.person.lastname' => 'last name',
            'editing.person.gender' => 'gender',
            'editing.person.nationality1' => 'nationality 1',
            'editing.person.nationality2' => 'nationality 2',
            'editing.person.country_of_residence' => 'residence country',
        ];
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
        $this->countries = Country::where('active', true)->orderBy('name')->get()->toArray();
        $this->countries_by_key = Country::where('active', true)->get()->keyBy('code')->toArray();
        if ($movie_id) {
            $this->movie = Movie::find($movie_id);
            $this->load();
        }
        $this->backoffice = $backoffice;
        $this->recalculatePoints();
    }

    public function render()
    {
        return view('livewire.table-edit-movie-crews', ['fiche' => 'dist']);
    }

    protected function sendItems()
    {
        $this->emitUp('update-movie-crews', $this->items);
    }

    protected function recalculatePoints()
    {
        $this->points_total = 0;
        foreach ($this->items as $item) {
            if (isset($item['points'])) {
                $this->points_total += $item['points'];
            }
        }
    }

    public function saveItem()
    {
        parent::saveItem();
        $this->recalculatePoints();
    }

    public function deleteItem() {
        parent::deleteItem();
        $this->recalculatePoints();
    }

}
