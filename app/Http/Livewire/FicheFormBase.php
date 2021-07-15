<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Helpers\FormHelpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class FicheFormBase extends Component
{

    public $isNew = false;
    public $isApplicant = false;
    public $isEditor = false;
    public $previous;
    public $layout;

    protected function getListeners()
    {
        return [
            'addItem',
            'removeItem'
        ];
    }

    public function mount(Request $request)
    {
        $user = Auth::user();
        /** @var User $user */
        if ($user->hasRole('applicant')) {
            $this->isApplicant = true;
        }
        if ($user->hasRole('editor')) {
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

        $this->layout = 'components.' . ($this->isApplicant ? 'ecl-layout' : 'layout');

        if (isset($this->dossier) && isset($this->activity) && isset($this->fiche)) {
            $fiche_routes = $this->fiche->ficheTypeRoutes($this->dossier, $this->activity, $this->fiche);
        } else {
            $fiche_routes = $this->fiche->ficheTypeRoutes(null, null, $this->fiche);
        }
        $this->routeDetails = $fiche_routes['details_route'];
        $this->routeDossiers = $fiche_routes['dossiers_route'];
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
            $routes[] = [
                // TODO: this line breaks livewire and browser-sync (when running on localhost:3000)
                // TODO: gives error: Livewire\Exceptions\CorruptComponentPayloadException
                // 'url' => route('dossiers.index'),
                'url' => '/dossiers',
                'title' => 'My dossiers',
            ];
            if (isset($this->dossier)) {
                $routes[] = [
                    // TODO: this line breaks livewire and browser-sync (when running on localhost:3000)
                    // TODO: gives error: Livewire\Exceptions\CorruptComponentPayloadException
                    // 'url' => url('dossiers/'.$this->dossier->project_ref_id),
                    'url' => '/dossiers/'.$this->dossier->project_ref_id,
                    'title' => 'Edit dossier',
                ];
            }
            if ($this->admissionsTable && $this->admission) {
                $routes[] = [
                    'title' => 'Edit admission',
                    'url' => route('admission', [$this->dossier, $this->admissionsTable, $this->admission])
                ];
            }    
            $routes[] = [
                    'title' => 'Edit fiche'
            ];
            return $routes;
        } else {
            return [
                [
                    'title' => 'My dossiers'
                ],
            ];
        }
    }

}
