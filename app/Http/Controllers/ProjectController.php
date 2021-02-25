<?php

namespace App\Http\Controllers;

use App\Models\Call;
use App\Models\Dossier;
use App\Models\Movie;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class ProjectController extends Controller
{

    protected $dossierRules = [
        'company' => 'required_without:film_title|string|min:3',
        'film_title' => 'required_without:company',
    ];

    protected $pageTitles = [
        'DISTSEL' => 'Films on the Move',
        'DISTSAG' => 'European Sales Support',
        'DEVSLATE' => 'European Slate Development',
        'DEVSLATEMINI' => 'European Mini-slate Development',
        'CODEVELOPMENT' => 'European Co-development',
        'TV' => 'TV and Online Content',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Display all projects
        $layout = $this->getLayout();
        // $dossiers = Dossier::forUser()->orderBy('updated_at', 'desc')->get();
        $crumbs = $this->getCrumbs();

        return view('dossiers.index', compact('crumbs', 'layout'));
    }

    /**
     * Show the form for creating a new resource.
     * @TODO Keep in mind: call deadline
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
            'created_by' => Auth::user()->id,
        ]);

        $layout = $this->getLayout();
        $pageTitles = $this->pageTitles;

        return redirect()->route('dossiers.show', $dossier);
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
    public function show(Dossier $dossier)
    {
        $layout = $this->getLayout();
        $pageTitles = $this->pageTitles;
        $crumbs = $this->getCrumbs();

        return view('dossiers.create', compact('crumbs', 'dossier', 'layout', 'pageTitles'));
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

        $params = $request->only(['company']);

        $dossier = Dossier::findOrFail($id);

        $dossier->fill([
            'company' => $params['company'],
            'status_id' => Status::NEW,
            'updated_by' => Auth::user()->id,
        ]);
        $dossier->save();

        return redirect()->route('dossiers.index');
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

        // if ($request->has('short_films')) {
        //     $rules['short_films'] = $this->getMinMaxRule('short_films');
        // }

        // if ($request->has('film_id')) {
        //     $rules['film_id'] = 'required|integer';
        // }

        // if ($request->has('coordinator_count')) {
        //     $minCoordinators = $request->input('min_coordinators');
        //     $rules['coordinator_count'] = "integer|min:{$minCoordinators}";
        // }

        // if ($request->has('participant_count')) {
        //     $minParticipants = $request->input('min_participants');
        //     $rules['participant_count'] = "integer|min:{$minParticipants}";
        // }

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

    protected function getLayout()
    {
        $user = Auth::user();

        if ($user->hasRole('applicant')) {
            return 'ecl-layout';
        }

        return 'layout';
    }

    protected function getCrumbs()
    {
        $currentRoute = Route::getCurrentRoute()->action['as'];

        if ($currentRoute === 'dossiers.show') {
            return [
                [
                    'url' => route('dossiers.index'),
                    'title' => 'My dossiers',
                ],
                [
                    'title' => 'Edit dossier',
                ],
            ];
        } else {
            return [
                [
                    'title' => 'My dossiers'
                ],
            ];
        }
    }
}
