<?php

namespace App\Http\Livewire;

use App\Models\Movie;
use App\Models\SalesAgent;
use App\Models\Country;

class TableEditMovieSalesAgents extends TableEditBase
{

    public Movie $movie;

    public $isApplicant = false;

    public $isEditor = false;

    public $countries = [];

    public $countries_by_code = [];

    public $distributorRoles;

    public $salesAgentErrorMessages;

    protected $listeners = ['salesAgentErrorMessages'];

    protected function defaults()
    {
        return SalesAgent::defaultsSalesAgent() + parent::defaults();
    }

    protected function rules()
    {
        return [
            'editing.name' => 'required|string|max:255',
            'editing.country' => 'required|string',
            'editing.contact_person' => 'required|string|max:255',
            'editing.email' => 'required|string|max:255',
            'editing.distribution_date' => '',
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
            'editing.country' => 'country',
            'editing.contact_person' => 'contact person',
            'editing.email' => 'email',
            'editing.distribution_date' => 'date',
        ];
    }

    private function loadItems()
    {
        $this->items = SalesAgent::where('movie_id', $this->movie->id)->get()->toArray();
        $this->addUniqueKeys();
    }

    public function mount($movie_id = null)
    {
        $this->countries = Country::where('active', true)->orderBy('name')->get()->toArray();
        $this->countries_by_code = Country::where('active', true)->orderBy('name')->get()->keyBy('code')->toArray();
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
        return view('livewire.table-edit-movie-sales-agents', ['fiche' => 'dist', 'rules' => $this->rules()]);
    }

    protected function sendItems()
    {
        $this->emitUp('updateMovieSalesAgents', $this->items);
    }

    public function salesAgentErrorMessages($messages) {
        $this->salesAgentErrorMessages = $messages;
    }
}
