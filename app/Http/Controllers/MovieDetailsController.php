<?php

namespace App\Http\Controllers;

use App\Movie;
use Illuminate\Http\Request;

class MovieDetailsController extends Controller
{

    /**
     * Show movie details edit form
     */
    public function show(Movie $movie){
        return view('movie-detail', ['movie_id' => $movie->id]);
    }

    /**
     * Form for creating new movie
     */
    public function create()
    {
        return view('movie-detail');
    }

}
