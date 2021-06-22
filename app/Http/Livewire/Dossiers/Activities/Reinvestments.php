<?php

namespace App\Http\Livewire\Dossiers\Activities;

use App\Models\User;
use App\Models\Dossier;
use Livewire\Component;
use App\Models\Reinvestment;
use Illuminate\Support\Facades\Auth;

class Reinvestments extends Component
{

    public Dossier $dossier;

    public $isBackoffice = false;

    public $showAddModal = false;
    public $showDeleteModal = false;

    public $editId = null;
    public $deleteId = null;

    // The authenticated user
    public User $user;

    public Reinvestment $currentReinvestment;

    public $print = false;

    protected $rules = [
        // 'currentReinvestment.fiche_id' => 'required|integer',
        'currentReinvestment.type_subtype' => 'string',
        'currentReinvestment.grant' => 'integer',
    ];

    public function mount(Dossier $dossier)
    {
        $this->user = Auth::user();
        $this->isBackoffice = $this->user->hasAnyRole(['editor', 'admin']);
        $this->currentReinvestment = new Reinvestment();
    }

    public function showAdd($id = null)
    {

        if ($id) {
            $this->editId = $id;
            $this->currentReinvestment = $this->dossier
                ->reinvestments()
                ->find($id);
        } else {
            $this->editId = null;
            $this->currentReinvestment = new Reinvestment();
        }

        $this->showAddModal = true;
    }

    public function showDelete($id)
    {
        $this->showDeleteModal = true;
        $this->deleteId = $id;
    }

    public function addReinvestment()
    {
        $this->validate();

        if ($this->editId) {
            $this->currentReinvestment->updated_by = $this->user->id;
            $this->dossier
                ->reinvestments()
                ->find($this->editId)
                ->update($this->currentReinvestment->toArray());
        } else {
            $this->currentReinvestment->created_by = $this->user->id;
            $this->dossier
                ->reinvestments()
                ->save($this->currentReinvestment);
        }

        $this->currentReinvestment = new Reinvestment();
        $this->showAddModal = false;
    }

    public function deleteReinvestment()
    {
        $this->dossier->reinvestments()
            ->find($this->deleteId)
            ->delete();
        $this->deleteId = null;
        $this->showDeleteModal = false;
    }


    public function render()
    {
        $reinvestments = $this->dossier->reinvestments();
        // $reinvestments = collect([]);

        return view('livewire.dossiers.activities.reinvestments', [
            'reinvestments' => $reinvestments->count() ? $reinvestments->get() : collect([]),
            'print' => $this->print,
        ]);
    }
}
