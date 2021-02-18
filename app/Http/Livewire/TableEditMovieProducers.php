<?php

namespace App\Http\Livewire;

use App\Models\Movie;
use App\Models\Producer;
use App\Models\Country;

class TableEditMovieProducers extends TableEditBase
{

    public Movie $movie;

    public $countries = [];

    public $countries_by_code = [];

    public $languages = [];

    public $budget_total = 0;

    public $producerErrorMessages;

    protected $listeners = ['producerErrorMessages'];

    protected function defaults()
    {
        return Producer::defaultsProducer() + parent::defaults();
    }

    protected function rules()
    {
        return [
            'editing.role' => 'required|string',
            'editing.name' => 'required|string|max:255',
            'editing.city' => 'required|string|max:255',
            'editing.country' => 'required|string',
            'editing.language' => 'string',
            'editing.share' => 'required|integer|min:1|max:100',
            'editing.budget' => '',
        ] + TableEditBase::rules();
    }

    public function tableEditRules($isEditor)  {
        $rules = $this->rules() + TableEditBase::rules();
        return parent::rulesCleanup($rules);
    }

    protected function validationAttributes()
    {
        return [
            'editing.movie_id' => 'movie_id',
            'editing.role' => 'role',
            'editing.name' => 'company name',
            'editing.city' => 'city',
            'editing.country' => 'country',
            'editing.language' => 'language',
            'editing.share' => 'share',
            'editing.budget' => 'budget',
        ];
    }

    private function loadItems()
    {
        $this->items = Producer::where('movie_id', $this->movie->id)->get()->toArray();
        $this->addUniqueKeys();
    }

    public function mount($movie_id = null)
    {
        $this->countries = Country::where('active', true)->orderBy('name')->get()->toArray();
        $this->countries_by_code = Country::where('active', true)->orderBy('name')->get()->keyBy('code')->toArray();
        if ($movie_id) {
            $this->movie = Movie::find($movie_id);
            $this->loadItems();
        }
    }

    public function render()
    {
        return view('livewire.table-edit-movie-producers', ['fiche' => 'dist', 'rules' => $this->rules()]);
    }

    protected function sendItems()
    {
        $this->emitUp('updateMovieProducers', $this->items);
    }

    public function producerErrorMessages($messages) {
        $this->producerErrorMessages = $messages;
    }
}
