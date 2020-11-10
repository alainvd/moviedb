<?php

use App\Http\Controllers\MovieDetailsController;
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
});

Route::get('/alpine', function () {
    return view('alpine');
});

Route::get('/livewire', function () {
    return view('livewire');
});

Route::get('/tailwind', function () {
    return view('tailwind');
});

Route::get('movies', [\App\Http\Controllers\MovieController::class,'index']);
Route::get('/movie/detail/{movie}', [MovieDetailsController::class, 'show'])->name('movie_detail');

Route::resource('call', 'CallController')->only('index');
Route::resource('submission', 'SubmissionController')->only('index');
Route::resource('media', 'MediaController')->only('index');

Route::get('/auth/login', function(){
    cas()->authenticate();
});

Route::get('/auth/logout', [
    'middleware' => 'cas.auth',
    function(){
        cas()->logout();
    }
]);
Route::get('test/cas', [\App\Http\Controllers\TestController::class,'cas'])->middleware('cas.auth');

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

Route::get('internal', function () {
    return view('internal');
})->name('internal');

Route::get('movies', [MovieController::class, 'index'])->name('movies');
Route::get('/movie/detail/{movie}', [MovieDetailsController::class,'show',])->name('movie_detail');
