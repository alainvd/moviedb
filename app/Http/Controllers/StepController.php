<?php

namespace App\Http\Controllers;

use App\Step;
use Illuminate\Http\Request;

class StepController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $steps = Step::all();

        return view('step.index', compact('steps'));
    }
}
