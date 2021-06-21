<?php

namespace App\Http\Livewire;

use App\Models\Country;
use App\Models\Dossier;
use Livewire\Component;
use App\Models\Admission;
use Illuminate\Http\Request;
use App\Models\AdmissionsTable;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class AdmissionForm extends Component
{

    public $isNew = false;
    public $isApplicant = false;
    public $isEditor = false;

    public Dossier $dossier;
    public AdmissionsTable $admissionsTable;
    public ?Admission $admission = null;
    public array $countriesById;

    public $crumbs = [];

    protected $rulesApplicant = [
        'admission.admissions_table_id' => '',
        'admission.fiche_id' => '',
        'admission.local_title' => 'string',
        'admission.release_date' => 'required|date:d.m.Y',
        'admission.running_weeks' => 'required|integer',
        'admission.certified_admissions' => 'required|integer',
        'admission.screens_first_week' => 'required|integer',
        'admission.screens_widest_release_week' => 'required|integer',
        'admission.box_office_receipts' => 'required|integer', // numeric?
        'admission.comments' => 'string',
    ];

    protected $rulesEditor = [
        'admission.country_id' => 'integer',
        'admission.year' => 'integer',
    ];

    public function rules() {
        if ($this->isEditor) {
            return $this->rulesEditor;
        } else {
            return $this->rulesApplicant;
        }
    }

    public function getCrumbs() {
        $routes[] = [
            'url' => route('dossiers.index'),
            'title' => 'My dossiers',
        ];
        if (isset($this->dossier)) {
            $routes[] = [
                'url' => url('dossiers/'.$this->dossier->project_ref_id),
                'title' => 'Edit dossier',
            ];
        }
        $routes[] = [
                'title' => 'Edit admission'
        ];
        return $routes;
    }

    public function mount(Request $request)
    {
        if ($this->admissionsTable->dossier && request()->user()->cannot('view', $this->admissionsTable->dossier)) {
            abort(404);
        }

        $this->countriesById = Country::countriesById();
        if (!$this->admission) {
            $this->admission = new Admission([
                'admissions_table_id' => $this->admissionsTable->id,
            ]);
            $this->admission->save();
            $this->redirect(route('admission', [$this->dossier, $this->admissionsTable, $this->admission]));
        }
        /** @var \App\Models\User */
        $currentUser = Auth::user();
        if ($currentUser->hasRole('applicant')) {
            $this->isApplicant = true;
        }
        if ($currentUser->hasRole('editor')) {
            $this->isEditor = true;
        }
        $this->crumbs = $this->getCrumbs();
    }

    public function saveAdmission()
    {
        // validate
        $this->validate($this->rules());

        // save (will update or create)
        $this->admission->save();

        // redirect to dossier
        return redirect()->route('dossiers.show', ['dossier' => $this->dossier]);
    }

    public function render()
    {
        $title = 'Distribution Automatic - Declaration of Admissions';   
        $layout = 'components.' . ($this->isApplicant ? 'ecl-layout' : 'layout');

        return view('livewire.admission-form', [
            'rules' => $this->rules(),
            'layout' => $layout,
            'title' => $title,
            'crumbs' => $this->crumbs,
        ])
        ->layout($layout, [
            'title' => $title,
            'crumbs' => $this->crumbs,
        ]);
    }

}