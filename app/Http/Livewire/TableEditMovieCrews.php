<?php

namespace App\Http\Livewire;

use App\Models\Crew;
use App\Models\Movie;
use App\Models\Title;
use App\Models\Person;
use App\Models\Country;
use Illuminate\Support\Facades\Log;

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

    protected $listeners = [
        'movieCrewsAddRequired'
    ];

    protected function defaults()
    {
        return Crew::defaultsCrew() + parent::defaults();
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

    public function tableEditRules($isEditor)  {
        if ($isEditor) {
            $rules = $this->rulesEditor + TableEditBase::rules();
        } else {
            $rules = $this->rulesApplicant + TableEditBase::rules();
        }
        return parent::rulesCleanup($rules);
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

    private function loadItems()
    {
        $this->items = Crew::with('person')->where('movie_id',$this->movie->id)->get()->toArray();
        if ($this->movie) {
            $this->movieCrewsAddRequired($this->movie->genre_id);
        }
        $this->addUniqueKeys();
    }

    public function mount($movie_id = null, $isApplicant = false, $isEditor = false)
    {
        $this->titles = Title::all()->keyBy('id')->toArray();
        $this->genders = Person::GENDERS;
        $this->countries = Country::where('active', true)->orderBy('name')->get()->toArray();
        $this->countries_by_code = Country::where('active', true)->orderBy('name')->get()->keyBy('code')->toArray();
        $this->movie = new Movie();

        if ($movie_id) {
            $this->movie = Movie::find($movie_id);
            $this->loadItems();
        }
        $this->isApplicant = $isApplicant;
        $this->isEditor = $isEditor;
        $this->recalculatePoints();
    }

    public function render()
    {
        return view('livewire.table-edit-movie-crews', ['fiche' => 'dist', 'rules' => $this->rules()]);
    }

    protected function sendItems()
    {
        $this->emitUp('updateMovieCrews', $this->items);
    }

    protected function recalculatePoints()
    {
        $this->points_total = 0;
        foreach ($this->items as $item) {
            if (isset($item['points'])) {
                $this->points_total += $item['points'];
            }
        }
        $this->emit('totalPointsCrews', $this->points_total);
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

    public function movieCrewsAddRequired($genre_id) {
        $req_items = Crew::newMovieCrew($genre_id);
        $req_items_title_ids = array_column($req_items, 'title_id');
        foreach ($req_items as $req_item) {
            if (!array_filter(
                $this->items,
                function ($item) use ($req_item) {
                    return $item['title_id'] == $req_item['title_id'];
                }
            ))
            {
                $this->items[] = $req_item;
            }
        }
        $this->items = array_map(
            function($item) use ($req_items, $req_items_title_ids) {
                // mark as required or not
                if (in_array($item['title_id'], $req_items_title_ids)) {
                    $item['required'] = true;
                } else {
                    $item['required'] = false;
                }
                return $item;
            },
            $this->items
        );
        $this->addUniqueKeys();
        $this->sendItems();
    }
    
}
