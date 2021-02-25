<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Dossier;
use App\Http\Livewire\MovieDistForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $movies = Movie::simplePaginate(30);

        return view('movies.list', compact(['movies']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }


    public function show(Movie $movie)
    {
        return view('movies.show', compact(['movie']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Movie  $movie
     * @return Illuminate\Support\Facades\Route
     */
    public function edit(Movie $movie)
    {
        if($movie->fiche->type === 'dist')
        {
           return redirect()->route('movie-dist', ['fiche' => $movie]);
        }
        elseif($movie->fiche->type === 'dev-prev')
        {
            return redirect()->route('movie-dev-prev', ['fiche' => $movie]);
         }
        elseif($movie->fiche->type === 'dev-current')
        {
             return redirect()->route('movie-dev-current', ['fiche' => $movie]);
          }

        else
        {
            return view('movies.show', compact(['movie']));
        }    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Movie $movie)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function destroy(Movie $movie)
    {
        //
    }
}
