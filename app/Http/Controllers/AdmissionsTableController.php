<?php

namespace App\Http\Controllers;

use App\Models\AdmissionsTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdmissionsTableController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $admissionsTables = AdmissionsTable::all();

        return view('admissions_table.index', compact('admissionsTables'));
    }

    public function prepare($admissionsTable) {

        // TODO: complete this
        $crumbs = [];
        /** @var \App\Models\User */
        $currentUser = Auth::user();
        $layout = ($currentUser->hasRole('applicant') ? 'ecl-layout' : 'layout');

        return compact('admissionsTable', 'crumbs', 'layout');
        
    }
}
