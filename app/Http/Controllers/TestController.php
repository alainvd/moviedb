<?php

namespace App\Http\Controllers;

use App\Audience;
use App\Media;
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
        $medium = Media::where('grantable_type','App\Movie')->paginate(30);


        return view('test.browse.movies', compact('medium'));
    }

    public function audience()
    {
        $audience = Audience::all();
        return view('test.browse.audience', compact('audience'));
    }
}
