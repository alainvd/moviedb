<?php

namespace App\Http\Controllers;

use App\Movie;
use Illuminate\Http\Request;

class MovieDetailsController extends Controller
{

    private function default_values() {

        $languages = [
            "French","Bulgarian","English","German","Italian","Spanish","Arab","Bambara","Tamashek","Danish"
        ];

        $countries = [
            "BE"=>"Belgium",
            "FR"=>"France"
        ];

        $years = [];
        for ($year=2020; $year>1990; $year-- ){
            $years[]=$year;
        }

        $genres = [
            "Fiction",
            "Creative Documentary",
            "Animation",
            "Series",
            "Live-action children film",
        ];

        return [$languages, $countries, $years, $genres];
    }

    public function show(Movie $movie){

        $cast = $movie->getCast();
        $crew = $movie->getCrew();
        [$languages, $countries, $years, $genres] = $this->default_values();

        return view('movie-detail', compact(['movie','crew','cast','languages','years','genres','countries']));
    }

    public function create()
    {
        $movie = new Movie;
        $cast = [];
        $crew = [];
        [$languages, $countries, $years, $genres] = $this->default_values();
        return view('movie-detail', compact(['movie','crew','cast','languages','years','genres','countries']));
    }

}
