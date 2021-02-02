<?php

namespace App\Http\Controllers;

use App\Models\FilmFinancingPlan;
use Illuminate\Http\Request;

class FilmFinancingPlanController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filmFinancingPlans = FilmFinancingPlan::all();

        return view('film_financing_plans.index', compact('filmFinancingPlans'));
    }
}
