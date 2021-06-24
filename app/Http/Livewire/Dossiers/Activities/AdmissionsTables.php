<?php

namespace App\Http\Livewire\Dossiers\Activities;

use App\Models\Country;
use App\Models\Admission;
use App\Models\AdmissionsTable;
use Illuminate\Support\Collection;
use App\Helpers\IntegerEmptyToNull;

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

    public function rules()
    {
        return $this->rules;
    }

    public function mount()
    {
        $this->admissionsTables = AdmissionsTable::where(['dossier_id' => $this->dossier->id])->get();
        // Create default table if none exists
        if ($this->admissionsTables->isEmpty()) {
            AdmissionsTable::create([
                'dossier_id' => $this->dossier->id,
                'country_id' => null,
                'year' => date('Y'),
            ]);
            $this->admissionsTables = AdmissionsTable::where(['dossier_id' => $this->dossier->id])->get();
        }
        $this->countriesById = Country::countriesById();
        $this->countriesGrouped = Country::countriesGrouped();
        $this->years = range(date('Y'), date('Y')-1);
    }

    public function updated($name, $value)
    {
        // if integer field set to empty, make sure it's saved as null
        $this->integerEmptyToNull_Single($name);

        list($var, $index, $property) = explode('.', $name);
        $this->admissionsTables[$index]->save();
    }

    public function addTable()
    {
        $newTable = AdmissionsTable::create([
            'dossier_id' => $this->dossier->id,
            'country_id' => null,
            'year' => date('Y'),
        ]);
        // add the new table at the end of collection
        $this->admissionsTables->push($newTable);
    }

    public function delete() {
        if ($this->deletingId) {
            Admission::find($this->deletingId)->delete();
            $this->deletingId = null;
            $this->showDeleteModal = false;
            $this->admissionsTables = AdmissionsTable::where(['dossier_id' => $this->dossier->id])->get();
        }
    }

    public function render()
    {
        return view('livewire.dossiers.activities.admissions_tables');
    }
}
