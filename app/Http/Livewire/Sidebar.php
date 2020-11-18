<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Route;
use Livewire\Component;

class Sidebar extends Component
{
    public $active = '';

    public function __construct()
    {
        // dd(Route::current()->uri);
    }

    public function render()
    {
        return view('livewire.sidebar');
    }
}
