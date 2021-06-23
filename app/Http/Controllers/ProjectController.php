<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Call;
use App\Models\Movie;
use App\Models\Status;
use App\Models\Dossier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use Spatie\Activitylog\Models\Activity as ActivityLog;

/**
 * @todo change to DossierController
 * @todo handle unique project_ref_id exception
 */
class ProjectController extends Controller
{
    protected $picSearchUrl = 'https://ec.europa.eu/info/funding-tenders/opportunities/api/organisation/search.json';

    protected $dossierRules = [
        'film_title' => 'required_with:movie_count',
    ];

    protected $pageTitles = [
        'FILMOVE' => 'Films on the Move',
        'DISTSAG' => 'European Sales Support',
        'DEVSLATE' => 'European Slate Development',
        'DEVMINISLATE' => 'European Mini-slate Development',
        'CODEV' => 'European Co-development',
        'TVONLINE' => 'TV and Online Content',
        'DEVVG' => 'Videogame development',
        'DISTAUTOG' => 'Distribution Automatic'
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        /** @var User $user */
        if ($user->hasRole('editor')) {
            return redirect()->to(route('datatables-dossiers'));
        }

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
        $validator = Validator::make(request()->all(), [
            // 'action_type' => 'required',
            'call_id' => 'bail|required',
            'draft_proposal_id' => 'bail|required',
            'PIC' => 'required',
            // 'topic' => 'required',
        ]);

        if (App::environment('production')) {
            if ($validator->fails()) {
                abort(500, 'SEP link seems to be broken');
            }
        }

        $params = request(['call_id', 'draft_proposal_id', 'PIC', 'topic']);

        $call = Call::where('name', $params['call_id'])->first();

        if (!$call) {
            abort(500, 'The call in your request could not be found');
        }

        if (App::environment('production')) {
            if ($call->closed) {
                abort(500, 'We do not accept any more applications for this call');
            }

            $company = $this->getCompanyByPic($params['PIC']);
        } else {
            $company = 'Test company';
        }

        $dossier = Dossier::firstOrNew([
            'project_ref_id' => $params['draft_proposal_id']
        ]);

        if ($dossier->id) {
            return redirect()->route('dossiers.show', $dossier);
        }

        $dossier->fill([
            'call_id' => $call->id,
            'company' => $company,
            'pic' => $params['PIC'],
            'action_id' => $call->action_id,
            'status_id' => 1,
            'year' => date('Y'),
            'contact_person' => Auth::user()->email,
            'created_by' => Auth::user()->id,
        ]);
        $dossier->save();

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
        if (request()->user()->cannot('view', $dossier)) {
            abort(404);
        }

        $layout = $this->getLayout();
        $pageTitles = $this->pageTitles;
        $crumbs = $this->getCrumbs();
        $print = false;
        $hasHistory = ActivityLog::forSubject($dossier)->count() > 0;

        return view('dossiers.create', compact('crumbs', 'dossier', 'hasHistory', 'layout', 'pageTitles', 'print'));
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
        $dossier = Dossier::findOrFail($id);

        if ($request->user()->cannot('update', $dossier)) {
            return abort(404);
        }

        if ($dossier->call->closed) {
            abort(500, 'We do not accept any more applications for this call');
        }

        $this->validate($request, $this->buildValidator($request));

        // Check if there are any fiches in DRAFT and prevent submit
        $hasAnyDrafts = $dossier->fiches()->where('status_id', Status::DRAFT)
            ->count();

        if ($hasAnyDrafts) {
            $request->session()
                ->flash(
                    'error',
                    'Cannot submit dossier while works are in DRAFT'
                );
            return redirect()->back();
        }

        $dossier->fill([
            'status_id' => Status::NEW,
            'updated_by' => Auth::user()->id,
        ]);
        $dossier->save();

        $request->session()
            ->flash(
                'success',
                "Dossier {$dossier->project_ref_id} saved successfully"
            );
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

        if ($request->has('participant_count')) {
            $rules['participant_count'] = $this->getMinMaxRule('participants');
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

    protected function getLayout()
    {
        $user = Auth::user();
        /** @var User $user */
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

    protected function getCompanyByPic($pic)
    {
        $request = Http::post($this->picSearchUrl, [
            'pic' => $pic
        ])->collect();

        $results = $request->collect();
        if (!$results->count()) {
            abort(500, 'The provided PIC is invalid');
        }

        return $results[0]['legalName'];
    }
}
