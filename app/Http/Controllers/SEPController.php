<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SEPController extends Controller
{
    public function index(Request $request)
    {
        $validated = $request->validate([
            'call_id' => 'required',
            'topic' => 'required',
            'action_type' => 'required',
            'draft_proposal_id' => 'required',
            'PIC' => 'required',
        ]);

        dump('Data Received from SEP.');
        dump("Cas user: " . cas()->user());
        dd($validated);
    }
}
