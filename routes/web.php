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

<<<<<<< HEAD
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

=======
>>>>>>> 9a5803e1e267585a0765210b8e1162a3b9fbd318
Route::get('homepage', function () {
    return view('homepage');
})->name('homepage');

$dossiers = [
<<<<<<< HEAD
    [
        'id' => 1,
=======
    (object) [
>>>>>>> 9a5803e1e267585a0765210b8e1162a3b9fbd318
        'project' => 'PROJECT REF ID',
        'shield' => true,
        'call' => 'Call DISTRAUTO 2020',
        'edit' => false,
        'closed' => false,
    ],
<<<<<<< HEAD
    [
        'id' => 2,
=======
    (object) [
>>>>>>> 9a5803e1e267585a0765210b8e1162a3b9fbd318
        'project' => 'PROJECT REF ID',
        'shield' => false,
        'call' => 'Call DISTRAUTO 2020',
        'edit' => false,
        'closed' => false,
    ],
<<<<<<< HEAD
    [
        'id' => 3,
=======
    (object) [
>>>>>>> 9a5803e1e267585a0765210b8e1162a3b9fbd318
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
<<<<<<< HEAD
})->name('internal');
=======
});
>>>>>>> 9a5803e1e267585a0765210b8e1162a3b9fbd318

Route::get('movies', [MovieController::class, 'index'])->name('movies');
Route::get('/movie/detail/{movie}', [MovieDetailsController::class,'show',])->name('movie_detail');
