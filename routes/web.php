<?php

use App\Models\Call;
use App\Models\Fiche;
use App\Models\Dossier;
use App\Models\Activity;
use App\Http\Livewire\Export;
use App\Http\Livewire\MovieTVForm;
use Illuminate\Support\Facades\App;
use App\Http\Livewire\AdmissionForm;
use App\Http\Livewire\MovieDistForm;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PICController;
use App\Http\Livewire\MovieDevPrevForm;
use App\Http\Controllers\TestController;
use App\Http\Livewire\VideoGamePrevForm;
use App\Http\Controllers\FicheController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\SearchController;
use App\Http\Livewire\MovieDevCurrentForm;
use App\Http\Controllers\DossierController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\ProjectController;
use App\Http\Livewire\Dossiers\MovieWizard;
use App\Http\Controllers\DashboardController;
use App\Http\Livewire\TableEditMovieDocuments;
use App\Http\Controllers\ImpersonateController;
use App\Http\Controllers\TableEditExamplesController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/cas/logout', [
    'middleware' => 'cas.auth',
    function(){
        cas()->logout();
    }
])->name('cas-logout');

// Root route
Route::get('/', function () {
    if (auth()->user()) {
        $user = Auth::user();
        /** @var User $user */
        if ($user->hasRole('editor')) {
            return redirect('dashboard/dossiers');
        }
        if ($user->hasRole('applicant')) {
            return redirect('dossiers');
        }
    }
    if (App::environment('production')) {
        return redirect('welcome');
    } else {
        return redirect('homepage');
    }
})->name('root');

if (!App::environment('production')) {
    Route::get('homepage', [
        'middleware' => 'cas.auth',
        function () {
            $calls = Call::open()->get();
            return view('homepage', compact('calls'));
        }
    ])->name('homepage');
}

Route::get('/welcome', [
    function () {
        return view('welcome');
    }
])->name('welcome');

Route::get('/search', [SearchController::class, 'index'])
    ->name('search');

Route::get('/landing/SEP', function () {
    return redirect()->route('dossiers.create', request()->all());
})->name('sep');

Route::middleware('cas.auth')->group(function () {
    // Editor dashboard
    Route::prefix('dashboard')
        ->middleware('can:access dashboard')
        ->group(function () {
            Route::redirect('/', 'dashboard/dossiers')->name('dashboard');

            // Datatables
            Route::get('/dossiers', function () {
                return view('livewire.dossier-datatables',['title' => "Dossiers"]);
            })->name('datatables-dossiers');
            Route::get('/movies', function () {
                return view('livewire.movie-datatables', ['title' => "Movies"]);
            })->name('datatables-movies');

            Route::get('/export', Export::class);
        });

    // Dossiers routes
    Route::resource('dossiers', ProjectController::class)
        ->scoped([
            'dossier' => 'project_ref_id'
        ])->name('index', 'dossiers.index');

    // PDF output
    Route::get('/dossiers/{dossier:project_ref_id}/download-full', [DossierController::class, 'downloadFullDossier'])
        ->name('dossier-full-download');
    if (!App::environment('production')) {
        Route::get('/dossiers/{dossier:project_ref_id}/print', [DossierController::class, 'printDossier'])
            ->name('dossier-print');
        Route::get('/fiche/{fiche}/print', [FicheController::class, 'printFiche'])
            ->name('fiche-print');
        Route::get('/fiche/{fiche}/download', [FicheController::class, 'downloadFiche'])
            ->name('fiche-download');
    }

    // History routes
    Route::resource('dossiers/{dossier}/history', HistoryController::class)
        ->scoped([
            'dossier' => 'project_ref_id'
        ])
        ->only('index')
        ->name('index', 'dossier-history');
    Route::get('dossiers/{dossier:project_ref_id}/activity/{activity}/fiche/{fiche}/history', [HistoryController::class, 'fiche'])
        ->middleware('can:access dashboard')
        ->name('fiche-history');
    Route::get('fiche/{fiche}/history', [HistoryController::class, 'fiche'])
        ->middleware('can:access dashboard')
        ->name('fiche-history-no-dossier');

    // Movie wizard
    Route::get('/dossiers/{dossier:project_ref_id}/activity/{activity}/movie-wizard', MovieWizard::class)
        ->name('movie-wizard');

    Route::get('/admission/{dossier:project_ref_id}/{admissionsTable}/{admission?}', AdmissionForm::class)->middleware('cas.auth')->name('admission');
});

// Redirect for 'dossier-create-fiche', shows the correct form based on:
//  - activity within dossier (description - which is typically dist; previous-work etc.)
//  - action (which action is dossier for - FILMOVE, TVONLINE etc.)
Route::get('/dossiers/{dossier:project_ref_id}/activities/{activity}/fiche-redirect/{fiche?}', function(Dossier $dossier, Activity $activity, Fiche $fiche = null) {

    if ($activity->name == 'description')
        return redirect()->route('dist-fiche-form', ['dossier' => $dossier, 'activity' => $activity, 'fiche' => $fiche]);

    if ($activity->name == 'previous-work' && $dossier->action->name == 'DEVVG')
        return redirect()->route('vg-prev-fiche-form', ['dossier' => $dossier, 'activity' => $activity, 'fiche' => $fiche]);
    if ($activity->name == 'previous-work')
        return redirect()->route('dev-prev-fiche-form', ['dossier' => $dossier, 'activity' => $activity, 'fiche' => $fiche]);

    if ($activity->name == 'current-work' && $dossier->action->name == 'TVONLINE')
        return redirect()->route('tv-fiche-form', ['dossier' => $dossier, 'activity' => $activity, 'fiche' => $fiche]);
    if ($activity->name == 'current-work' && $dossier->action->name == 'DEVVG')
        return redirect()->route('vg-current-fiche-form', ['dossier' => $dossier, 'activity' => $activity, 'fiche' => $fiche]);
    if ($activity->name == 'current-work')
        return redirect()->route('dev-current-fiche-form', ['dossier' => $dossier, 'activity' => $activity, 'fiche' => $fiche]);

    if ($activity->name == 'short-films')
        return redirect()->route('dev-current-fiche-form', ['dossier' => $dossier, 'activity' => $activity, 'fiche' => $fiche]);

    if ($activity->name == 'admissions-tables') {
        $admissionsTable = request()->input('admissionsTable') ?? null;
        $admission = request()->input('admission') ?? null;
        return redirect()->route('dist-fiche-form', ['dossier' => $dossier, 'activity' => $activity, 'fiche' => $fiche, 'admissionsTable' => $admissionsTable, 'admission' => $admission]);
    }

})->middleware('cas.auth')->name('dossier-create-fiche');

// Fiches within dossier context
Route::middleware('cas.auth')->group(function () {
    Route::get('/dossiers/{dossier:project_ref_id}/activities/{activity}/fiche/dist/{fiche?}', MovieDistForm::class)
        ->name('dist-fiche-form');
    Route::get('/dossiers/{dossier:project_ref_id}/activities/{activity}/fiche/dev-current/{fiche?}', MovieDevCurrentForm::class)
        ->name('dev-current-fiche-form');
    Route::get('/dossiers/{dossier:project_ref_id}/activities/{activity}/fiche/dev-prev/{fiche?}', MovieDevPrevForm::class)
        ->name('dev-prev-fiche-form');
    Route::get('/dossiers/{dossier:project_ref_id}/activities/{activity}/fiche/tv/{fiche?}', MovieTVForm::class)
        ->name('tv-fiche-form');
    // Route::get('/dossiers/{dossier:project_ref_id}/activities/{activity}/fiche/vg-current/{fiche?}', VideoGameCurrentForm::class)
    //     ->name('vg-current-fiche-form');
    // Route::get('/dossiers/{dossier:project_ref_id}/activities/{activity}/fiche/vg-prev/{fiche?}', VideoGamePrevForm::class)
    //     ->name('vg-prev-fiche-form');
});

// Stand alone fiches
Route::middleware('cas.auth')->group(function () {
    Route::get('/browse/movies/{fiche}', [MovieController::class,'edit'])
        ->name('movie_show');
    // Applicant can submit a stand alone dist fiche
    Route::get('/movie-dist/{fiche?}', MovieDistForm::class)
        ->name('movie-dist');
    // Applicant can not not submit other stand alone fiches
    Route::get('/movie-dev-current/{fiche?}', MovieDevCurrentForm::class)
        ->name('movie-dev-current');
    Route::get('/movie-dev-prev/{fiche?}', MovieDevPrevForm::class)
        ->name('movie-dev-prev');
    Route::get('/movie-tv/{fiche?}', MovieTVForm::class)
        ->name('movie-tv');
    // Route::get('/vg-current/{fiche?}', VideoGameCurrentForm::class)
    //     ->name('vg-current');
    // Route::get('/vg-prev/{fiche?}', VideoGamePrevForm::class)
    //     ->name('vg-prev');
});

// File download
Route::get('document-download', [TableEditMovieDocuments::class, 'download'])->middleware('cas.auth')->name('document-download');

// Impersonation
Route::get('/impersonate/{id}', [ImpersonateController::class, 'impersonate'])->middleware('cas.auth')->name('impersonate')->where('id', '[0-9]+');
Route::get('/impersonate/stop', [ImpersonateController::class, 'stopImpersonate'])->middleware('cas.auth')->name('impersonate_stop');

// Pending
Route::view('/reports', 'coming-soon')->middleware('cas.auth');

// Test Routes
if (!App::environment('production')) {
    Route::get('/test', [TestController::class,'index'])->name('test_index');
    Route::get('/test/cas', [TestController::class,'cas'])->middleware('cas.auth');
    Route::get('/test/select', [TestController::class,'select'])->middleware('cas.auth');
    Route::get('/pic', [PICController::class,'index'])->middleware('cas.auth')->name('pic');
    Route::get('table-edit-example', [TableEditExamplesController::class,'examples'])->middleware('cas.auth')->name('table_edit_examples');
    // Route::get('/browse/movies', [TestController::class,'movies']);
    Route::get('/browse/movies', [MovieController::class,'index'])->middleware('cas.auth')->name('movies');
    Route::get('/browse/audience', [TestController::class,'audience'])->middleware('cas.auth');
    Route::get('/browse/crew', [TestController::class,'crew'])->middleware('cas.auth');
}

// Generated
if (!App::environment('production')) {
    Route::resource('call', '\App\Http\Controllers\CallController')->middleware('cas.auth')->only('index');
    Route::resource('submission', '\App\Http\Controllers\SubmissionController')->middleware('cas.auth')->only('index');
    Route::resource('step', 'App\Http\Controllers\StepController')->middleware('cas.auth')->only('index');
    Route::resource('step-definition', 'App\Http\Controllers\StepDefinitionController')->middleware('cas.auth')->only('index');
    Route::resource('checklist', 'App\Http\Controllers\ChecklistController')->middleware('cas.auth')->only('index');
    Route::resource('person', 'App\Http\Controllers\PersonController')->middleware('cas.auth')->only('index');
    Route::resource('title', 'App\Http\Controllers\TitleController')->middleware('cas.auth')->only('index');
    Route::resource('crew', 'App\Http\Controllers\CrewController')->middleware('cas.auth')->only('index');
    Route::resource('audience', 'App\Http\Controllers\AudienceController')->middleware('cas.auth')->only('index');
    Route::resource('genre', 'App\Http\Controllers\GenreController')->middleware('cas.auth')->only('index');
    Route::resource('producer', 'App\Http\Controllers\ProducerController')->middleware('cas.auth')->only('index');
    Route::resource('sales-agent', 'App\Http\Controllers\SalesAgentController')->middleware('cas.auth')->only('index');
    Route::resource('sales-distributor', 'App\Http\Controllers\SalesDistributorController')->middleware('cas.auth')->only('index');
    Route::resource('document', 'App\Http\Controllers\DocumentController')->middleware('cas.auth')->only('index');
    Route::resource('location', 'App\Http\Controllers\LocationController')->middleware('cas.auth')->only('index');
    Route::resource('admissions-table', 'App\Http\Controllers\AdmissionsTableController')->middleware('cas.auth')->only('index');
}