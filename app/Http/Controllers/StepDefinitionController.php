<?php

namespace App\Http\Controllers;

use App\Models\StepDefinition;
use Illuminate\Http\Request;

class StepDefinitionController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $stepDefinitions = StepDefinition::all();

        return view('stepdefinitions.index', compact('stepDefinitions'));
    }
}
