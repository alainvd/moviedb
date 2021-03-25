<?php

namespace App\Http\Livewire;

use App\Models\Movie;
use App\Models\Country;
use App\Models\SalesDistributor;
use Illuminate\Support\Facades\Log;

class TableEditMovieSalesDistributors extends TableEditBase
{

    public Movie $movie;

    public $countries = [];

    public $countries_by_code = [];

    public $countries_value_label = [];

    public $countries_grouped_value_label = [];

    public $distributorRoles;

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
        $this->countries_by_code = Country::where('active', true)->orderBy('name')->get()->keyBy('code')->toArray();
        $this->countries_value_label = Country::where('active', true)
            ->get()
            ->map(fn ($country) => [
                'value' => $country->id,
                'label' => $country->name,
            ])
            ->toArray();
        $countries_grouped = Country::where('active', true)
            ->get()
            ->sortBy([
                function ($a, $b) {
                    if ($a['group'] == 'eu' && $b['group'] == 'eu') return 0;
                    if ($a['group'] == 'eu' && $b['group'] == 'select') return -1;
                    if ($a['group'] == 'eu' && $b['group'] == 'other') return -1;
                    if ($a['group'] == 'select' && $b['group'] == 'eu') return 1;
                    if ($a['group'] == 'select' && $b['group'] == 'select') return 0;
                    if ($a['group'] == 'select' && $b['group'] == 'other') return -1;
                    if ($a['group'] == 'other' && $b['group'] == 'eu') return 1;
                    if ($a['group'] == 'other' && $b['group'] == 'select') return 1;
                    if ($a['group'] == 'other' && $b['group'] == 'other') return 0;
                },
                fn ($a, $b) => $a['position'] <=> $b['position'],
                fn ($a, $b) => $a['name'] <=> $b['name']
            ])
            ->map(fn ($country) => [
                'group' => $country->group,
                'value' => $country->id,
                'label' => $country->name,
            ])
            ->groupBy('group')
            ->toArray();
        $i = 0;
        foreach ($countries_grouped as $group => $choices) {
            $i++;
            $this->countries_grouped_value_label[] = [
                'label' => '---',
                'id' => $i,
                'choices' => $choices,
            ];
        }
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

    public function showModalEdit($key = null)
    {
        parent::showModalEdit($key);

        // Reinit Choices widget with different country values
        $editing_countries_ids = collect($this->editing['countries'])->pluck('id')->toArray();
        $countries_values = collect($this->countries_value_label)->filter(
            function ($c) use ($editing_countries_ids) {
                return in_array($c['value'], $editing_countries_ids);
            }
        )->values();
        $this->emit('showModalInit', $countries_values);
    }

    public function showModalAdd()
    {
        parent::showModalAdd();
        $this->emit('showModalInit', []);
    }

    public function addCountry($id) {
        $current_countries = collect($this->editing['countries'])->pluck('id')->toArray();
        if (!in_array($id, $current_countries)) {
            $this->editing['countries'][] = ['id' => $id];
        }
    }

    public function removeCountry($id) {
        $this->editing['countries'] = array_filter(
            $this->editing['countries'],
            function ($c) use ($id) {return $c['id'] !== $id;}
        );
    }
    
}
