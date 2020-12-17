<?php

namespace App\Http\Controllers;

use App\Call;
use App\Dossier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Display all projects
    }

    /**
     * Show the form for creating a new resource.
     *
     * What do I need?
     * * call_id
     * * project_ref_id ? (might create a new project)
     * *
     *
     * Keep in mind: call deadline
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->validate(request(), [
            'call_id' => 'required',
            'project_ref_id' => 'required',
        ]);
        $params = request(['call_id', 'project_ref_id']);

        $call = Call::find($params['call_id']);

        $dossier = Dossier::firstOrCreate([
            'call_id' => $params['call_id'],
            'project_ref_id' => $params['project_ref_id'],
            'action_id' => $call->action_id,
            'status_id' => 1,
            'year' => date('Y'),
            'contact_person' => Auth::user()->email,
        ]);

        return view('projects.create', compact('dossier'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
