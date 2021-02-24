<?php

namespace App\Http\Livewire\Dossiers;

use App\Models\Dossier;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class MyDossiers extends Component
{
    public $showClosed = true;

    public ?User $user;

    public function mount()
    {
        $this->user = Auth::user();
    }

    public function render()
    {
        // Status callback for filtering
        $callback = function ($query) {
            $query->where('status', 'open');
        };

        $query = Dossier::forUser($this->user->id);

        if (! $this->showClosed) {
            $query->whereHas('call', $callback)
                ->with(['call' => $callback]);
        }

        $query->orderBy('updated_at', 'desc');
        $dossiers = $query->get();

        return view('livewire.dossiers.my-dossiers', compact('dossiers'));
    }
}
