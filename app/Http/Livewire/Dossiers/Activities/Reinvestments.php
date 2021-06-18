<?php

namespace App\Http\Livewire\Dossiers\Activities;

use App\Models\User;
use App\Models\Dossier;
use Livewire\Component;
use App\Models\Reinvested;
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

    public Reinvested $currentReinvested;

    public $print = false;

    protected $rules = [
        // 'currentReinvested.fiche_id' => 'required|integer',
        'currentReinvested.type_subtype' => 'string',
        'currentReinvested.grant' => 'integer',
    ];

    public function mount(Dossier $dossier)
    {
        $this->user = Auth::user();
        $this->isBackoffice = $this->user->hasAnyRole(['editor', 'admin']);
        $this->currentReinvested = new Reinvested();
    }

    public function showAdd($id = null)
    {

        if ($id) {
            $this->editId = $id;
            $this->currentReinvested = $this->dossier
                ->reinvested()
                ->find($id);
        } else {
            $this->editId = null;
            $this->currentReinvested = new Reinvested();
        }

        $this->showAddModal = true;
    }

    public function showDelete($id)
    {
        $this->showDeleteModal = true;
        $this->deleteId = $id;
    }

    public function addReinvested()
    {
        $this->validate();

        if ($this->editId) {
            $this->currentReinvested->updated_by = $this->user->id;
            $this->dossier
                ->reinvested()
                ->find($this->editId)
                ->update($this->currentReinvested->toArray());
        } else {
            $this->currentReinvested->created_by = $this->user->id;
            $this->dossier
                ->reinvested()
                ->save($this->currentReinvested);
        }

        $this->currentReinvested = new Reinvested();
        $this->showAddModal = false;
    }

    public function deleteReinvested()
    {
        $this->dossier->reinvested()
            ->find($this->deleteId)
            ->delete();
        $this->deleteId = null;
        $this->showDeleteModal = false;
    }


    public function render()
    {
        $reinvested = $this->dossier->reinvested();
        // $reinvested = collect([]);

        return view('livewire.dossiers.activities.reinvestments', [
            'reinvested' => $reinvested->count() ? $reinvested->get() : collect([]),
            'print' => $this->print,
        ]);
    }
}
