<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FicheFormBase extends Component
{

    public $isNew = false;
    public $isApplicant = false;
    public $isEditor = false;

    public $crews = [];
    public $producers = [];
    public $sales_agents = [];
    public $documents = [];

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
            $this->emit('validation-errors');
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

    public function updateMovieCrews($items)
    {
        $this->crews = $items;
    }

    public function updateMovieProducers($items)
    {
        $this->producers = $items;
    }

    public function updateMovieSalesAgents($items)
    {
        $this->sales_agents = $items;
    }

    public function updateMovieDocuments($items)
    {
        $this->documents = $items;
    }

}