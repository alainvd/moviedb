<?php

use App\Http\Controllers\CreateFicheController;
use App\Models\Call;
use App\Models\Action;
use Illuminate\Http\Request;
use App\Http\Livewire\MovieTVForm;
use App\Http\Livewire\MovieDistForm;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\MovieDatatables;
use App\Http\Controllers\MovieController;
use App\Http\Livewire\MovieDevCurrentForm;
use Symfony\Component\Console\Input\Input;
use App\Http\Controllers\ProjectController;
use App\Http\Livewire\Dossiers\MovieWizard;
use App\Http\Livewire\MovieDevPreviousForm;
use App\Http\Livewire\VideoGamePreviousForm;

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

Route::get('/', function () {
    return view('welcome');
})->name('welcome');


Route::get('/auth/login', function(){
    cas()->authenticate();
});

Route::get('/test/cas/logout', [
    'middleware' => 'cas.auth',
    function(){
        cas()->logout();
    }
]);

Route::get('homepage', function () {
    $calls = Call::where('status', 'open')
        ->get();
    return view('homepage', compact('calls'));
})->name('homepage');

$dossiers = [
    [
        'id' => 1,
        'project' => 'PROJECT REF ID',
        'shield' => true,
        'call' => 'Call DISTRAUTO 2020',
        'edit' => false,
        'closed' => false,
    ],
    [
        'id' => 2,
        'project' => 'PROJECT REF ID',
        'shield' => false,
        'call' => 'Call DISTRAUTO 2020',
        'edit' => false,
        'closed' => false,
    ],
    [
        'id' => 3,
        'project' => 'PROJECT REF ID',
        'shield' => false,
        'call' => 'Call DISTRAUTO 2019 - CLOSED',
        'edit' => true,
        'closed' => true,
    ],
];

Route::get('dossiers-public', function () use ($dossiers) {
    return view('dossiers', ['dossiers' => $dossiers]);
})->name('dossiers-public');

Route::resource('dossiers', ProjectController::class)
    ->scoped([
        'dossier' => 'project_ref_id'
    ])
    ->middleware('cas.auth');

Route::get('/dossiers/{dossier:project_ref_id}/activity/{activity}/movie-wizard', MovieWizard::class)
    ->middleware('cas.auth')
    ->name('movie-wizard');

// One path that redirects to correct fiche form based on activity
Route::get('/dossiers/{dossier:project_ref_id}/activities/{activity}/fiches/{fiche?}', function($dossier, $activity, $fiche = null) {
    if ($activity == 1) return redirect()->route('dist-fiche-form', ['dossier' => $dossier, 'activity' => $activity, 'fiche' => $fiche]);
    if ($activity == 2) return redirect()->route('dev-prev-fiche-form', ['dossier' => $dossier, 'activity' => $activity, 'fiche' => $fiche]);
    if ($activity == 3) return redirect()->route('dev-current-fiche-form', ['dossier' => $dossier, 'activity' => $activity, 'fiche' => $fiche]);
})->middleware('cas.auth')->name('dossier-create-fiche');

Route::get('/dossiers/{dossier:project_ref_id}/activities/{activity}/fiche/dist/{fiche?}', MovieDistForm::class)->middleware('cas.auth')->name('dist-fiche-form');
Route::get('/dossiers/{dossier:project_ref_id}/activities/{activity}/fiche/dev-prev/{fiche?}', MovieDevPreviousForm::class)->middleware('cas.auth')->name('dev-prev-fiche-form');
Route::get('/dossiers/{dossier:project_ref_id}/activities/{activity}/fiche/dev-current/{fiche?}', MovieDevCurrentForm::class)->middleware('cas.auth')->name('dev-current-fiche-form');
Route::get('/dossiers/{dossier:project_ref_id}/activities/{activity}/fiche/tv/{fiche?}', MovieTVForm::class)->middleware('cas.auth')->name('tv-fiche-form');
Route::get('/dossiers/{dossier:project_ref_id}/activities/{activity}/fiche/vg-prev/{fiche?}', VideoGamePreviousForm::class)->middleware('cas.auth')->name('vg-prev-fiche-form');

Route::get('/imporsonate/{id}/impersonate', [\App\Http\Controllers\ImpersonateController::class, 'impersonate'])->middleware('cas.auth')->name('impersonate');
Route::get('/imporsonate/stop', [\App\Http\Controllers\ImpersonateController::class, 'stopImpersonate'])->middleware('cas.auth')->name('impersonate_stop');

Route::get('/movie-dist/{fiche?}', MovieDistForm::class)->middleware('cas.auth')->name('movie-dist-1');

Route::get('/movie-dev-current/{fiche?}', MovieDevCurrentForm::class)->middleware('cas.auth')->name('movie-dev-current');
Route::get('/movie-dev-prev/{fiche?}', MovieDevPreviousForm::class)->middleware('cas.auth')->name('movie-dev-prev');
Route::get('/movie-dist/{fiche?}', MovieDistForm::class)->middleware('cas.auth')->name('movie-dist');
Route::get('/movie-tv/{fiche?}', MovieTVForm::class)->middleware('cas.auth')->name('movie-tv');
//Route::get('/dossier/{project}', ProjectController::class)->middleware('cas.auth');

//Pending
Route::get('table-edit-example', 'App\Http\Controllers\TableEditExamplesController@examples')->name('table_edit_examples');
Route::view('/reports', 'coming-soon');


Route::get('/dossiers/{dossier}/activities/{activity}/fiches/tv/{fiche?}', MovieTVForm::class)->middleware('cas.auth');

Route::get('select', [\App\Http\Controllers\TestController::class,'select']);

Route::get('/media/{fiche?}', MovieDistForm::class)->middleware('cas.auth')->name('dist-fiche');

Route::get('/browse/movies', [\App\Http\Controllers\TestController::class,'movies']);

//Test Routes
Route::get('/test', [\App\Http\Controllers\TestController::class,'index'])->name('test_index');
Route::get('test/cas', [\App\Http\Controllers\TestController::class,'cas'])->middleware('cas.auth');
Route::get('/test/select', [\App\Http\Controllers\TestController::class,'select']);
//Route::get('/browse/movies', [\App\Http\Controllers\TestController::class,'movies']);



Route::get('/browse/audience', [\App\Http\Controllers\TestController::class,'audience']);
Route::get('/browse/crew', [\App\Http\Controllers\TestController::class,'crew']);
Route::view('/demo', 'demo');
Route::get('dashboard', [\App\Http\Controllers\DashboardController::class,'index'])->middleware(['cas.auth','can:access dashboard'])->name('dashboard');
Route::get('/browse/movies', [MovieController::class,'index'])->name('movies');
Route::get('/browse/movies/{fiche}', [MovieController::class,'edit'])->name('movie_show');


Route::get('/landing/SEP', [\App\Http\Controllers\SEPController::class,'index'])->middleware(['cas.auth'])->name('SEP');

Route::resource('call', '\App\Http\Controllers\CallController')->only('index');
Route::resource('submission', '\App\Http\Controllers\SubmissionController')->only('index');
Route::resource('step', 'App\Http\Controllers\StepController')->only('index');
Route::resource('step-definition', 'App\Http\Controllers\StepDefinitionController')->only('index');
Route::resource('checklist', 'App\Http\Controllers\ChecklistController')->only('index');
Route::resource('person', 'App\Http\Controllers\PersonController')->only('index');
Route::resource('title', 'App\Http\Controllers\TitleController')->only('index');
Route::resource('crew', 'App\Http\Controllers\CrewController')->only('index');
Route::resource('audience', 'App\Http\Controllers\AudienceController')->only('index');
Route::resource('genre', 'App\Http\Controllers\GenreController')->only('index');
Route::resource('producer', 'App\Http\Controllers\ProducerController')->only('index');
Route::resource('sales-agent', 'App\Http\Controllers\SalesAgentController')->only('index');
Route::resource('sales-distributor', 'App\Http\Controllers\SalesDistributorController')->only('index');
Route::resource('document', 'App\Http\Controllers\DocumentController')->only('index');
Route::resource('location', 'App\Http\Controllers\LocationController')->only('index');

Route::get('document-download', [App\Http\Livewire\TableEditMovieDocuments::class, 'download'])->middleware('cas.auth')->name('document-download');

//Data Tables
Route::get('dossiers-datatables', function () {
    return view('livewire.dossier-datatables',['title' => "Search Dossier"]);});
Route::get('movies', function () {
    return view('livewire.movie-datatables',['title' => "Search Movies"]);});

