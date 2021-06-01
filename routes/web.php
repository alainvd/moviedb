<?php

use App\Models\Call;
use App\Http\Livewire\Export;
use App\Http\Livewire\MovieTVForm;
use Illuminate\Support\Facades\App;
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
});

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

// Route::get('/auth/login', function(){
//     cas()->authenticate();
// });

Route::get('/test/cas/logout', [
    'middleware' => 'cas.auth',
    function(){
        cas()->logout();
    }
])->name('cas-logout');

Route::get('homepage', [
    'middleware' => 'cas.auth',
    function () {
        $calls = Call::where('status', 'open')->get();
        return view('homepage', compact('calls'));
    }
])->name('homepage');

Route::middleware('cas.auth')->group(function () {
    // Editor dashboard
    Route::prefix('dashboard')
        ->middleware('can:access dashboard')
        ->group(function () {
            Route::redirect('/', 'dashboard/dossiers')->name('dashboard');

            // Datatables
            Route::get('/dossiers', function () {
                return view('livewire.dossier-datatables',['title' => "Search Dossier"]);
            })->name('datatables-dossiers');
            Route::get('/movies', function () {
                return view('livewire.movie-datatables', ['title' => "Search Movies"]);
            })->name('datatables-movies');

            Route::get('/export', Export::class);
        });

    // Dossiers routes
    Route::resource('dossiers', ProjectController::class)
        ->scoped([
            'dossier' => 'project_ref_id'
        ])->name('index', 'dossiers.index');

    // History routes
    Route::resource('dossiers/{dossier}/history', HistoryController::class)
        ->scoped([
            'dossier' => 'project_ref_id'
        ])
        ->only('index')
        ->name('index', 'dossier-history');

    Route::get('dossiers/{dossier:project_ref_id}/fiches/{fiche}/history', [HistoryController::class, 'fiche'])
        ->name('fiche-history');
    Route::get('fiches/{fiche}/history', [HistoryController::class, 'fiche'])
        ->name('fiche-history-no-dossier');

    // Movie wizard
    Route::get('/dossiers/{dossier:project_ref_id}/activity/{activity}/movie-wizard', MovieWizard::class)
        ->name('movie-wizard');
});

// One path that redirects to correct fiche form based on activity
Route::get('/dossiers/{dossier:project_ref_id}/activities/{activity}/fiches/{fiche?}', function(\App\Models\Dossier $dossier, $activity, $fiche = null) {
    if ($activity == 1 && $dossier->action_id==7) return redirect()->route('tv-fiche-form', ['dossier' => $dossier, 'activity' => $activity, 'fiche' => $fiche]);
    if ($activity == 1) return redirect()->route('dist-fiche-form', ['dossier' => $dossier, 'activity' => $activity, 'fiche' => $fiche]);
    if ($activity == 2) return redirect()->route('dev-prev-fiche-form', ['dossier' => $dossier, 'activity' => $activity, 'fiche' => $fiche]);
    if ($activity == 3 && $dossier->action_id==7) return redirect()->route('tv-fiche-form', ['dossier' => $dossier, 'activity' => $activity, 'fiche' => $fiche]);
    if ($activity == 3) return redirect()->route('dev-current-fiche-form', ['dossier' => $dossier, 'activity' => $activity, 'fiche' => $fiche]);
    if ($activity == 5) return redirect()->route('dev-current-fiche-form', ['dossier' => $dossier, 'activity' => $activity, 'fiche' => $fiche]);
})->middleware('cas.auth')->name('dossier-create-fiche');

Route::get('/dossiers/{dossier:project_ref_id}/activities/{activity}/fiche/dist/{fiche?}', MovieDistForm::class)->middleware('cas.auth')->name('dist-fiche-form');
Route::get('/dossiers/{dossier:project_ref_id}/activities/{activity}/fiche/dev-prev/{fiche?}', MovieDevPrevForm::class)->middleware('cas.auth')->name('dev-prev-fiche-form');
Route::get('/dossiers/{dossier:project_ref_id}/activities/{activity}/fiche/dev-current/{fiche?}', MovieDevCurrentForm::class)->middleware('cas.auth')->name('dev-current-fiche-form');
Route::get('/dossiers/{dossier:project_ref_id}/activities/{activity}/fiche/tv/{fiche?}', MovieTVForm::class)->middleware('cas.auth')->name('tv-fiche-form');
// Route::get('/dossiers/{dossier:project_ref_id}/activities/{activity}/fiche/vg-prev/{fiche?}', VideoGamePrevForm::class)->middleware('cas.auth')->name('vg-prev-fiche-form');

Route::get('/browse/movies/{fiche}', [MovieController::class,'edit'])->middleware('cas.auth')->name('movie_show');
Route::get('/movie-dist/{fiche?}', MovieDistForm::class)->middleware('cas.auth')->name('movie-dist');
Route::get('/movie-dev-current/{fiche?}', MovieDevCurrentForm::class)->middleware('cas.auth')->name('movie-dev-current');
Route::get('/movie-dev-prev/{fiche?}', MovieDevPrevForm::class)->middleware('cas.auth')->name('movie-dev-prev');
Route::get('/movie-tv/{fiche?}', MovieTVForm::class)->middleware('cas.auth')->name('movie-tv');
// Route::get('/vg-prev/{fiche?}', VideoGamePrevForm::class)->middleware('cas.auth')->name('vg-prev');

// Impersonation
Route::get('/impersonate/{id}', [ImpersonateController::class, 'impersonate'])->middleware('cas.auth')->name('impersonate')->where('id', '[0-9]+');
Route::get('/impersonate/stop', [ImpersonateController::class, 'stopImpersonate'])->middleware('cas.auth')->name('impersonate_stop');

// Pending
Route::view('/reports', 'coming-soon')->middleware('cas.auth');

// Test Routes
Route::get('/test', [TestController::class,'index'])->name('test_index');
Route::get('/test/cas', [TestController::class,'cas'])->middleware('cas.auth');
Route::get('/test/select', [TestController::class,'select'])->middleware('cas.auth');
Route::get('/pic', [PICController::class,'index'])->middleware('cas.auth')->name('pic');
Route::get('table-edit-example', [TableEditExamplesController::class,'examples'])->middleware('cas.auth')->name('table_edit_examples');
// Route::get('/browse/movies', [TestController::class,'movies']);

Route::get('/browse/audience', [TestController::class,'audience'])->middleware('cas.auth');
Route::get('/browse/crew', [TestController::class,'crew'])->middleware('cas.auth');
Route::view('/demo', 'demo')->middleware('cas.auth');
Route::get('dashboard', [DashboardController::class,'index'])->middleware(['cas.auth','can:access dashboard'])->name('dashboard');
Route::get('/browse/movies', [MovieController::class,'index'])->middleware('cas.auth')->name('movies');

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

Route::get('document-download', [TableEditMovieDocuments::class, 'download'])->middleware('cas.auth')->name('document-download');

Route::get('/dossiers/{dossier:project_ref_id}/print', [DossierController::class, 'printDossier'])->middleware('cas.auth')->name('dossier-print');
Route::get('/dossiers/{dossier:project_ref_id}/download-full', [DossierController::class, 'downloadFullDossier'])->middleware('cas.auth')->name('dossier-full-download');
Route::get('/fiche/{fiche}/print', [FicheController::class, 'printFiche'])->middleware('cas.auth')->name('fiche-print');
Route::get('/fiche/{fiche}/download', [FicheController::class, 'downloadFiche'])->middleware('cas.auth')->name('fiche-download');
