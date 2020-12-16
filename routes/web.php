<?php

use App\Http\Controllers\MovieController;
use App\Http\Controllers\MovieDetailsController;
use App\Http\Livewire\MovieDetailForm;
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
Route::get('/movie/detail/eacea/{movie}', [MovieDetailsController::class, 'showForBackoffice'])->name('movie_detail_eacea');
Route::get('/movie/eacea/create', [MovieDetailsController::class, 'createForBackoffice'])->name('movie_create_eacea');
Route::get('/movie/detail/applicant/{movie}', [MovieDetailsController::class, 'showForApplicant'])->name('movie_detail_applicant');
Route::get('/movie/applicant/create', [MovieDetailsController::class, 'createForApplicant'])->name('movie_create_applicant');

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
    return view('homepage');
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
Route::get('dossiers', function () use ($dossiers) {
    return view('dossiers', ['dossiers' => $dossiers]);
})->name('dossiers');


Route::resource('dossier', 'App\Http\Controllers\DossierController')->only('index');

Route::view('/projects', 'coming-soon');
Route::view('/reports', 'coming-soon');


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

Route::get('table-edit-example', 'App\Http\Controllers\TableEditExamplesController@examples')->name('table_edit_examples');

Route::get('/fiches/dist/{fiche?}', MovieDetailForm::class)->middleware('cas.auth');


Route::get('select', [\App\Http\Controllers\TestController::class,'select']);

Route::get('/browse/movies', [\App\Http\Controllers\TestController::class,'movies']);
Route::get('/browse/audience', [\App\Http\Controllers\TestController::class,'audience']);
Route::get('/browse/crew', [\App\Http\Controllers\TestController::class,'crew']);





