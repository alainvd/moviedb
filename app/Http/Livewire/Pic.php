<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class Pic extends Component
{

    public $company;
    private $entities;

    public function mount()
    {
        $this->company = "Cineart";

    }



    public function getPIC(){
        return Http::post('https://ec.europa.eu/info/funding-tenders/opportunities/api/organisation/search.json', [
            'legalName' => $this->company
        ])->collect();
    }

    public function render()
    {
        return view('livewire.pic', [
            'entities' => $this->getPIC()
        ]);
    }
}
