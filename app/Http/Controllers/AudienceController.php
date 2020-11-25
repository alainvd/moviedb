<?php

namespace App\Http\Controllers;

use App\Audience;
use Illuminate\Http\Request;

class AudienceController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $audiences = Audience::all();

        return view('audience.index', compact('audiences'));
    }
}
