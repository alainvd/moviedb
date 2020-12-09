<?php

namespace App\Http\Controllers;

use App\Movie;
use Illuminate\Http\Request;

class MovieDetailsController extends Controller
{

    // /**
    //  * Show movie details edit form
    //  */
    // public function showForApplicant(Movie $movie){
    //     return view('movie-detail', [
    //         'template' => 'movie-detail-form-applicant',
    //         'movie_id' => $movie->id,
    //         'backoffice' => false
    //     ]);
    // }

    // /**
    //  * Show movie details edit form
    //  */
    // public function showForBackoffice(Movie $movie){
    //     return view('movie-detail', [
    //         'template' => 'movie-detail-form-backoffice',
    //         'movie_id' => $movie->id,
    //         'backoffice' => true
    //     ]);
    // }

    // /**
    //  * Form for creating new movie
    //  */
    // public function createForApplicant()
    // {
    //     return view('movie-detail', [
    //         'template' => 'movie-detail-form-applicant',
    //         'backoffice' => false
    //     ]);
    // }

    // /**
    //  * Form for creating new movie
    //  */
    // public function createForBackoffice()
    // {
    //     return view('movie-detail', [
    //         'template' => 'movie-detail-form-backoffice',
    //         'backoffice' => true
    //     ]);
    // }

    /**
     * Show create form
     */
    public function create()
    {
        return view('movie-detail', [
            'movie' => new Movie()
        ]);
    }

    /**
     * Show edit form
     */
    public function edit(Movie $movie)
    {
        return view('movie-detail', [
            'movie' => $movie
        ]);
    }
}
