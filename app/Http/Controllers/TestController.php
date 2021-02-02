<?php

namespace App\Http\Controllers;

use App\Models\Audience;

use App\Models\Movie;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function cas()
    {
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
        //$media = Media::where('grantable_id',17765)->first();

        $movie = Movie::first();

        return view('test.browse.crew', compact('movie'));
    }

    public function audience()
    {
        $audience = Audience::all();
        return view('test.browse.audience', compact('audience'));
    }
}
