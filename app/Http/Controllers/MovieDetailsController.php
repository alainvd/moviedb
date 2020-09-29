<?php

namespace App\Http\Controllers;

use App\Models\Person;
use Illuminate\Http\Request;

class MovieDetailsController extends Controller
{
    public function show(){
        $crew = [];
        $cast = [];

        $cast[] = Person::create([
            'role'=>"Actor 1",
            'name'=>"Jean-Luc Coulon",
            'gender'=>"M",
            "nationality1"=>"Belgium",
            "country_of_residence"=>"Belgium"
        ]);

        $cast[] = Person::create([
            'role'=>"Actor 2",
            'name'=>"François Damiens",
            'gender'=>"M",
            "nationality1"=>"Belgium",
            "country_of_residence"=>"Belgium"
        ]);

        $crew[] = Person::create([
            'role'=>"Director",
            'name'=>"Olivier Van Hoofstadt",
            'gender'=>"M",
            "nationality1"=>"Belgium",
            "country_of_residence"=>"Belgium"
        ]);

        $crew[] = Person::create([
            'role'=>"Writer",
            'name'=>"Olivier Legrain",
            'gender'=>"M",
            "nationality1"=>"Belgium",
            "country_of_residence"=>"Belgium"
        ]);



        return view('movie-detail', with([
            'crew' => $crew,
            'cast' => $cast,
        ]));
    }
}
