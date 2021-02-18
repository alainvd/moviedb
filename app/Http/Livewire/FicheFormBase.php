<?php

namespace App\Http\Livewire;

use App\Helpers\FormHelpers;
use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FicheFormBase extends Component
{

    public $isNew = false;
    public $isApplicant = false;
    public $isEditor = false;

    protected function getListeners()
    {
        return [
            'addItem',
            'removeItem'
        ];
    }

    public function mount(Request $request)
    {
        if (Auth::user()->hasRole('applicant')) {
            $this->isApplicant = true;
        }
        if (Auth::user()->hasRole('editor')) {
            $this->isEditor = true;
        }
        if ($this->isApplicant && $this->isNew) {
            $this->fiche->status_id = 1;
        }
    }

    public function render()
    {
        if($this->getErrorBag()->any()){
            // TODO: figure out why this is repeating all the time
            $this->notify('Validation errors', 'error');
        }
    }

    public function addItem($data)
    {
        $this->{$data[0]}->push($data[1]);
    }

    public function removeItem($data)
    {
        $this->{$data[0]} = $this->{$data[0]}->reject(
            fn ($item) => $item['value'] === $data[1]['value']
        );
    }

}