<?php

namespace App\Http\Livewire;

use App\Models\Location;
use App\Models\Movie;
use App\Models\Country;

class TableEditMovieLocations extends TableEditBase
{

    public Movie $movie;

    public $isApplicant = false;

    public $isEditor = false;

    public $countries = [];

    public $countries_by_code = [];

    public $locationTypes = [];

    public $points_total = 0;

    public $locationErrorMessages;

    protected $listeners = ['locationErrorMessages'];

    protected function defaults()
    {
        return Location::defaultsLocation() + parent::defaults();
    }

    protected $rulesApplicant = [
        'editing.type' => 'required|string',
        'editing.name' => 'required|string',
        'editing.country' => 'required|string',
        'editing.points' => '',
    ];

    protected $rulesEditor = [
        'editing.type' => 'required|string',
        'editing.name' => 'required|string',
        'editing.country' => 'required|string',
        'editing.points' => 'required|numeric',
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
            'editing.type' => 'type',
            'editing.name' => 'name',
            'editing.country' => 'country',
            'editing.points' => 'points',
        ];
    }

    private function loadItems()
    {
        $this->items = Location::where('movie_id',$this->movie->id)->get()->toArray();
        $this->addUniqueKeys();
    }

    public function mount($movie_id = null, $isApplicant = false, $isEditor = false)
    {
        $this->countries = Country::where('active', true)->orderBy('name')->get()->toArray();
        $this->countries_by_code = Country::where('active', true)->orderBy('name')->get()->keyBy('code')->toArray();
        $this->locationTypes = Location::LOCATION_TYPES;
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
        return view('livewire.table-edit-movie-locations', ['fiche' => 'dist', 'rules' => $this->rules()]);
    }

    protected function sendItems()
    {
        $this->emitUp('updateMovieLocations', $this->items);
    }

    protected function recalculatePoints()
    {
        $this->points_total = 0;
        foreach ($this->items as $item) {
            if (isset($item['points'])) {
                $this->points_total += $item['points'];
            }
        }
        $this->emit('totalPointsLocations', $this->points_total);
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

    public function locationErrorMessages($messages) {
        $this->locationErrorMessages = $messages;
    }

}
