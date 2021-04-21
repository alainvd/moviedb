<?php

namespace App\Http\Controllers;

use App\Models\Admission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdmissionController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $admissions = Admission::all();

        return view('admission.index', compact('admissions'));
    }

    public function prepare($admission) {

        // TODO: complete this
        $crumbs = [];
        /** @var \App\Models\User */
        $currentUser = Auth::user();
        $layout = ($currentUser->hasRole('applicant') ? 'ecl-layout' : 'layout');

        return compact('admission', 'crumbs', 'layout');
        
    }
}
