<?php

namespace App\Http\Livewire;

use Livewire\Component;

class DossierItem extends Component
{

    public $dossier;

    private $show_closed = false;

    protected $listeners = ['showClosedCalls', 'hideClosedCalls'];

    public function showClosedCalls()
    {
        $this->show_closed = true;
    }

    public function hideClosedCalls()
    {
        $this->show_closed = false;
    }

    public function render()
    {
        return view('livewire.dossier-item', [
            'dossier' => $this->dossier,
            'show_closed' => $this->show_closed,
        ]);
    }
}
