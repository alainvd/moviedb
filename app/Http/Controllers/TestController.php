<?php

namespace App\Http\Controllers;

use App\Models\Movie;

use App\Models\Audience;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index()
    {
        return view('test.index');
    }

    public function cas()
    {
        dd(cas()->getAttributes());
        return view('test.cas');
    }

    public function select()
    {

        return view('test.select');
    }

    public function movies()
    {

        $movies = Movie::simplePaginate(30);


        return view('test.browse.movies', compact('movies'));
    }

    public function crew()
    {

        $movie = Movie::first();

        return view('test.browse.crew', compact('movie'));
    }

    public function audience()
    {
        $audience = Audience::all();
        return view('test.browse.audience', compact('audience'));
    }
}
