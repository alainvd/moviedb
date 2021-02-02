<?php

namespace App\Http\Controllers;

use App\Models\Checklist;
use Illuminate\Http\Request;

class ChecklistController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $checklists = Checklist::all()->groupBy(['dossier_id','media_id']);

        return view('checklist.index', compact('checklists'));
    }
}
