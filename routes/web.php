<?php

use App\Call;
use App\Http\Controllers\MovieController;
use App\Http\Livewire\MovieDistForm;
use App\Http\Livewire\MovieDevPreviousForm;
use App\Http\Livewire\MovieDevCurrentForm;
use App\Http\Livewire\VideoGamePreviousForm;
use App\Http\Controllers\ProjectController;
use App\Http\Livewire\Dossiers\MovieWizard;
use App\Http\Livewire\MediaDatatables;
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

Route::get('movies', [MovieController::class,'index'])->name('movies');

Route::resource('call', '\App\Http\Controllers\CallController')->only('index');
Route::resource('submission', '\App\Http\Controllers\SubmissionController')->only('index');
Route::resource('media', '\App\Http\Controllers\MediaController')->only('index');

Route::get('/auth/login', function(){
    cas()->authenticate();
});

Route::get('/test/cas/logout', [
    'middleware' => 'cas.auth',
    function(){
        cas()->logout();
    }
]);

Route::get('test/cas', [\App\Http\Controllers\TestController::class,'cas'])->middleware('cas.auth');

Route::get('dashboard', [\App\Http\Controllers\DashboardController::class,'index'])->middleware(['cas.auth','can:access dashboard'])->name('dashboard');

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

Route::resource('dossier', 'App\Http\Controllers\DossierController')->only('index');

Route::resource('/dossiers', ProjectController::class)->middleware('cas.auth');
Route::view('/reports', 'coming-soon');
Route::get('/dossiers/{dossier}/movie-wizard', MovieWizard::class)
    ->middleware('cas.auth')
    ->name('movie-wizard');

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

Route::resource('document', 'App\Http\Controllers\DocumentController')->only('index');
Route::get('document-download', [App\Http\Livewire\TableEditMovieDocuments::class, 'download'])->middleware('cas.auth')->name('document-download');

Route::get('table-edit-example', 'App\Http\Controllers\TableEditExamplesController@examples')->name('table_edit_examples');

Route::get('/dossiers/{dossier}/activities/{activity}/fiches/dist/{fiche?}', MovieDistForm::class)->middleware('cas.auth')->name('dist-fiche');
Route::get('/dossiers/{dossier}/activities/{activity}/fiches/dev-prev/{fiche?}', MovieDevPreviousForm::class)->middleware('cas.auth');
Route::get('/dossiers/{dossier}/activities/{activity}/fiches/dev-current/{fiche?}', MovieDevCurrentForm::class)->middleware('cas.auth');
Route::get('/dossiers/{dossier}/activities/{activity}/fiches/vg-prev/{fiche?}', VideoGamePreviousForm::class)->middleware('cas.auth');


Route::get('select', [\App\Http\Controllers\TestController::class,'select']);

Route::get('/browse/movies', [\App\Http\Controllers\TestController::class,'movies']);
Route::get('/browse/audience', [\App\Http\Controllers\TestController::class,'audience']);
Route::get('/browse/crew', [\App\Http\Controllers\TestController::class,'crew']);

Route::view('/demo', 'demo');


Route::get('dossiers', function () {
    return view('livewire.dossier-datatables');})->name('dossiers');

Route::get('media', function () {
        return view('livewire.media-datatables');})->name('bla');



Route::get('/imporsonate/{id}/impersonate', [\App\Http\Controllers\ImpersonateController::class, 'impersonate'])->middleware('cas.auth')->name('impersonate');
Route::get('/imporsonate/stop', [\App\Http\Controllers\ImpersonateController::class, 'stopImpersonate'])->middleware('cas.auth')->name('impersonate_stop');

Route::get('/media/{fiche?}', MovieDistForm::class)->middleware('cas.auth');
//Route::get('/dossier/{project}', ProjectController::class)->middleware('cas.auth');