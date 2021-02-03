<?php

namespace App\Http\Controllers;

use App\Models\Dossier;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $dossiers = Dossier::all();
        return view('dashboard', compact(['dossiers']));
    }
}
