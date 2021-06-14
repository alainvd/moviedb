<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Route;
use Livewire\Component;

class Navbar extends Component
{
    public $active = '';
    public $links = [
        // 'dashboard' => 'dashboard',
        'dossiers' => 'dashboard/dossiers',
        'movies' => 'dashboard/movies',
        // 'reports' => 'reports',
        // 'helpdesk' => 'helpdesk',
        'export' => 'dashboard/export'
    ];

    public function __construct()
    {
        $this->active = Route::current()->uri;
    }

    public function render()
    {
        return view('livewire.navbar');
    }
}
