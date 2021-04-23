<?php

namespace App\Http\Livewire\Dossiers\Activities;

use App\Helpers\IntegerEmptyToNull;
use App\Models\Country;
use App\Models\AdmissionsTable;
use Illuminate\Support\Collection;

class AdmissionsTables extends BaseActivity
{

    use IntegerEmptyToNull;

    public Collection $admissionsTables;
    public array $countriesById;
    public array $countriesGrouped;
    public array $years;

    protected $rules = [
        'admissionsTables.*.country_id' => 'required|integer',
        'admissionsTables.*.year' => 'required|integer',
    ];

    public function mount()
    {
        $this->admissionsTables = AdmissionsTable::where(['dossier_id' => $this->dossier->id])->get();
        $this->countriesById = Country::countriesById();
        $this->countriesGrouped = Country::countriesGrouped();
        $this->years = range(date('Y'), date('Y') - 11);
    }

    public function updated($name, $value)
    {
        list($var, $index, $property) = explode('.', $name);
        $this->admissionsTables[$index]->save();
    }

    public function addTable()
    {
        $firstCountryId = Country::where('active', true)
            ->orderBy('group')
            ->orderBy('position', 'asc')
            ->orderBy('name')
            ->first()
            ->id;
        $newTable = AdmissionsTable::create([
            'dossier_id' => $this->dossier->id,
            'country_id' => $firstCountryId,
            'year' => date('Y'),
        ]);
        // add the new table at the end of collection
        $this->admissionsTables->push($newTable);
    }

    public function render()
    {
        return view('livewire.dossiers.activities.admissions_tables');
    }
}
