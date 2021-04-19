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

    public function prepare() {

        // TODO: complete this
        $crumbs = [];
        $layout = (Auth::user()->hasRole('applicant') ? 'ecl-layout' : 'layout');
        $print = false;

        return compact('crumbs', 'layout', 'print');
        
    }


    // just a simple form for now
    public function admissionForm()
    {
        return view('admission.form', $this->prepare());
    }
}
