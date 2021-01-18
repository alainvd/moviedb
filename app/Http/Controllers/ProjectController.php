<?php

namespace App\Http\Controllers;

use App\Call;
use App\Dossier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{

    protected $dossierRules = [
        'company' => 'required|string|min:3'
    ];
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
        $this->validate($request, $this->buildValidator($request));

        $dossier = Dossier::findOrFail($id);
        $dossier->company = $request->input('company');
        $dossier->save();

        return redirect()->back();
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

    /**
     * Build validator array based on dossier activities and
     * activity rules
     *
     * @return array
     */
    protected function buildValidator(Request $request)
    {
        $rules = $this->dossierRules;

        if ($request->has('previous_works')) {
            $rules['previous_works'] = $this->getMinMaxRule('previous_works');
        }

        if ($request->has('current_works')) {
            $rules['current_works'] = $this->getMinMaxRule('current_works');
        }

        if ($request->has('film_id')) {
            $rules['film_id'] = 'required|integer';
        }

        if ($request->has('coordinator_count')) {
            $minCoordinators = $request->input('min_coordinators');
            $rules['coordinator_count'] = "integer|min:{$minCoordinators}";
        }

        if ($request->has('participant_count')) {
            $minParticipants = $request->input('min_participants');
            $rules['participant_count'] = "integer|min:{$minParticipants}";
        }

        return $rules;
    }

    protected function getMinMaxRule($field)
    {
        $min = request()->input("min_{$field}");
        $max = request()->input("max_{$field}");

        if (!$min && !$max) {
            return '';
        } elseif (!$min) {
            return "integer|max:{$max}";
        } elseif (!$max) {
            return "integer|min:{$min}";
        } elseif ($min === $max) {
            return "integer|size:{$min}";
        } else {
            return "integer|between:{$min},{$max}";
        }
    }
}
