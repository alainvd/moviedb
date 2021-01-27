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

    public $isApplicant = false;

    public $isEditor = false;

    public $titles = [];

    public $genders = [];

    public $countries = [];

    public $countries_by_code = [];

    public $points_total = 0;

    protected function defaults()
    {
        return [
            'points' => null,
            'person' => [
                'firstname' => '',
                'lastname' => '',
                'gender' => '',
                'nationality1' => '',
                'nationality2' => '',
                'country_of_residence' => '',
            ],
            'title_id' => null,
        ] + parent::defaults();
    }

    protected $rulesApplicant = [
        'editing.points' => '',
        'editing.person.firstname' => 'required|string|max:255',
        'editing.person.lastname' => 'required|string|max:255',
        'editing.person.gender' => 'required|string',
        'editing.person.nationality1' => 'required|string',
        'editing.person.nationality2' => 'string',
        'editing.person.country_of_residence' => 'string',
        'editing.title_id' => 'required|integer',
    ];

    protected $rulesEditor = [
        'editing.points' => 'required|numeric',
        'editing.person.firstname' => 'required|string|max:255',
        'editing.person.lastname' => 'required|string|max:255',
        'editing.person.gender' => 'required|string',
        'editing.person.nationality1' => 'required|string',
        'editing.person.nationality2' => 'string',
        'editing.person.country_of_residence' => 'string',
        'editing.title_id' => 'required|integer',
    ];

    protected function rules() {
        if ($this->isEditor) {
            return $this->rulesEditor + TableEditBase::rules();
        } else {
            return $this->rulesApplicant + TableEditBase::rules();
        }
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

    public function mount($movie_id = null, $isApplicant = false, $isEditor = false)
    {
        $this->titles = Title::all()->keyBy('id')->toArray();
        $this->genders = Person::GENDERS;
        $this->countries = Country::where('active', true)->orderBy('name')->get()->toArray();
        $this->countries_by_code = Country::where('active', true)->orderBy('name')->get()->keyBy('code')->toArray();
        if ($movie_id) {
            $this->movie = Movie::find($movie_id);
            $this->load();
        }
        $this->isApplicant = $isApplicant;
        $this->isEditor = $isEditor;
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
