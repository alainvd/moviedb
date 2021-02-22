<?php

namespace App\Http\Livewire;

use App\Models\Movie;
use App\Models\Country;
use App\Models\SalesDistributor;
use Illuminate\Support\Facades\Log;

class TableEditMovieSalesDistributors extends TableEditBase
{

    public Movie $movie;

    public $isApplicant = false;

    public $isEditor = false;

    public $countries = [];

    public $countries_by_code = [];

    public $countries_value_label = [];

    public $distributorRoles;

    public $salesDistributorErrorMessages;

    protected $listeners = ['salesDistributorErrorMessages'];

    protected function defaults()
    {
        return SalesDistributor::defaultsSalesDistributor() + parent::defaults();
    }

    protected function rules()
    {
        return [
            'editing.name' => 'required|string|max:255',
            'editing.role' => 'required|string',
            'editing.countries' => 'required',
            'editing.release_date' => 'required|date:d.m.Y',
        ] + TableEditBase::rules();
    }

    public function tableEditRules($isEditor)  {
        $rules = $this->rules() + TableEditBase::rules();
        return parent::rulesCleanup($rules);
    }
    
    protected function validationAttributes()
    {
        return [
            'editing.name' => 'company name',
            'editing.role' => 'role',
            'editing.countries' => 'countries',
            'editing.release_date' => 'release date',
        ];
    }

    private function loadItems()
    {
        $this->items = SalesDistributor::with('countries')->where('movie_id', $this->movie->id)->get()->toArray();
        $this->addUniqueKeys();
    }

    public function mount($movie_id = null)
    {
        $this->countries = Country::where('active', true)->orderBy('name')->get()->toArray();
        // dd($this->countries);
        $this->countries_by_code = Country::where('active', true)->orderBy('name')->get()->keyBy('code')->toArray();
        $this->countries_value_label = Country::where('active', true)
            ->get()
            ->map(fn ($country) => [
                'value' => $country->id,
                'label' => $country->name,
            ])
            ->toArray();
        $this->distributorRoles = [
            'PLATFORM' => 'Platform',
            'DISTRIBUTOR' => 'Distributor',
            'BROADCASTER' => 'Broadcaster',
        ];
        if ($movie_id) {
            $this->movie = Movie::find($movie_id);
            $this->loadItems();
        }
    }

    public function render()
    {
        return view('livewire.table-edit-movie-sales-distributors', ['fiche' => 'dev-prev', 'rules' => $this->rules()]);
    }

    protected function sendItems()
    {
        $this->emitUp('updateMovieSalesDistributors', $this->items);
    }

    public function salesDistributorErrorMessages($messages) {
        $this->salesDistributorErrorMessages = $messages;
    }

    public function updated() {
        // dd($this->editing['countries']);
    }

    public function showModalEdit($key = null)
    {
        parent::showModalEdit($key);
        // dd($this->editing['countries']);
        // $this->editing['countries_ids'] = collect($this->editing['countries'])->pluck('id')->toArray();
        // dd($this->editing['countries_ids']);

        // AHHHHHHHHH!
        // Choices need to be updated here (when edit form is opened):
        //  - setChoices (can be the same)
        //  - setValue (has to be from ...)
        //  - and generally reset the Choices thing. or even restart from scratch.
        //    - any way to init from zero?

        // how to reach choices component from livewire?
        // how to call choices functions? no way to do that!

        // can I fire an event???
        // or update a property and alpine/JS would react to that property
        //  - wire?
        //  - entangle? and then react to changes somehow

        $editing_countries_ids = collect($this->editing['countries'])->pluck('id')->toArray();
        $countries_values = collect($this->countries_value_label)->filter(
            function ($c) use ($editing_countries_ids) {
                return in_array($c['value'], $editing_countries_ids);
            }
        )->values();
        $this->emit('showModalInit', $countries_values);
        Log::Info('running edit');
    }

    public function showModalAdd()
    {
        parent::showModalAdd();
        $this->emit('showModalInit', []);
        Log::Info('running add');
    }

    public function addCountry($id) {
        // Log::info('addCountry:before', [$this->editing['countries']]);
        $current_countries = collect($this->editing['countries'])->pluck('id')->toArray();
        if (!in_array($id, $current_countries)) {
            $this->editing['countries'][] = ['id' => $id];
        }
        Log::info('addCountry:after', [$this->editing['countries']]);
    }

    public function removeCountry($id) {
        // Log::info('removeCountry:before', [$this->editing['countries']]);
        $this->editing['countries'] = array_filter(
            $this->editing['countries'],
            function ($c) use ($id) {return $c['id'] !== $id;}
        );
        Log::info('removeCountry:after', [$this->editing['countries']]);
    }
}
