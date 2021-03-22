<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Helpers\FormHelpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;

class FicheFormBase extends Component
{

    public $isNew = false;
    public $isApplicant = false;
    public $isEditor = false;
    public $previous;

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
        $this->previous = URL::previous();
        $this->crumbs = $this->getCrumbs();
    }

    public function render()
    {
        // if($this->getErrorBag()->any()){
        //     // TODO: figure out why this is repeating all the time
        //     $this->notify('Validation errors', 'error');
        // }
        // How do I limit that it would only show when I click validate button
        // Instead of when changing every field
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

    protected function getCrumbs()
    {
        $currentRoute = Route::getCurrentRoute()->action['as'];

        $ficheFormRoutes = [
            'dist-fiche-form',
            'dev-prev-fiche-form',
            'dev-current-fiche-form',
            'tv-fiche-form',
            'vg-prev-fiche-form',
        ];

        if (in_array($currentRoute, $ficheFormRoutes)) {
            return [
                [
                    'url' => route('dossiers.index'),
                    'title' => 'My dossiers',
                ],
                [
                    'url' => url('dossiers/'.$this->dossier->project_ref_id),
                    'title' => 'Edit dossier',
                ],
                [
                    'title' => 'Edit fiche'
                ],        
            ];
        } else {
            return [
                [
                    'title' => 'My dossiers'
                ],
            ];
        }
    }

}