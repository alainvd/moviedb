<?php

use App\Models\Call;
use App\Http\Controllers\MovieController;
use App\Http\Livewire\MovieDistForm;
use App\Http\Livewire\MovieDevPreviousForm;
use App\Http\Livewire\MovieDevCurrentForm;
use App\Http\Livewire\VideoGamePreviousForm;
use App\Http\Controllers\ProjectController;
use App\Http\Livewire\Dossiers\MovieWizard;
use App\Http\Livewire\MovieDatatables;
use App\Models\Action;
use Illuminate\Support\Facades\Route;

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

Route::resource('/dossiers', ProjectController::class)
    ->scoped([
        'dossier' => 'project_ref_id'
    ])
    ->middleware('cas.auth');

Route::get('/dossiers/{dossier:project_ref_id}/movie-wizard', MovieWizard::class)
    ->middleware('cas.auth')
    ->name('movie-wizard');

Route::get('film-financing-plan-download', [App\Http\Livewire\TableEditMovieFinancingPlan::class, 'download'])->middleware('cas.auth')->name('film-financing-plan-download');

Route::get('/dossiers/{dossier:project_ref_id}/activities/{activity}/fiches/dist/{fiche?}', MovieDistForm::class)->middleware('cas.auth')->name('dist-fiche');
Route::get('/dossiers/{dossier:project_ref_id}/activities/{activity}/fiches/dev-prev/{fiche?}', MovieDevPreviousForm::class)->middleware('cas.auth');
Route::get('/dossiers/{dossier:project_ref_id}/activities/{activity}/fiches/dev-current/{fiche?}', MovieDevCurrentForm::class)->middleware('cas.auth');
Route::get('/dossiers/{dossier:project_ref_id}/activities/{activity}/fiches/vg-prev/{fiche?}', VideoGamePreviousForm::class)->middleware('cas.auth');

Route::get('/imporsonate/{id}/impersonate', [\App\Http\Controllers\ImpersonateController::class, 'impersonate'])->middleware('cas.auth')->name('impersonate');
Route::get('/imporsonate/stop', [\App\Http\Controllers\ImpersonateController::class, 'stopImpersonate'])->middleware('cas.auth')->name('impersonate_stop');

Route::get('/media/{fiche?}', MovieDistForm::class)->middleware('cas.auth');
//Route::get('/dossier/{project}', ProjectController::class)->middleware('cas.auth');


//Pending
Route::get('table-edit-example', 'App\Http\Controllers\TableEditExamplesController@examples')->name('table_edit_examples');
Route::view('/reports', 'coming-soon');

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
Route::get('/browse/movies/{movie}', [MovieController::class,'show'])->name('movie_show');

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
Route::resource('film-financing-plan', 'App\Http\Controllers\FilmFinancingPlanController')->only('index');

//Data Tables
Route::get('/tables/dossiers', function () {
    return view('livewire.dossier-datatables');})->name('table_dossiers');
Route::get('/tables/movies', function () {
    return view('livewire.movie-datatables');})->name('table_movies');

//Unused Routes
