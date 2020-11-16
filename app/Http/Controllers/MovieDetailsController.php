<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Person;
use Illuminate\Http\Request;

class MovieDetailsController extends Controller
{


    public function show(Movie $movie){


        $cast = $movie->getCast();
        $crew = $movie->getCrew();

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






        return view('movie-detail', compact(['movie','crew','cast','languages','years','genres','countries']));
    }
}
