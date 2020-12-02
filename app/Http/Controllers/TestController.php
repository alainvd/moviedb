<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function cas()
    {
        return view('test.cas');
    }

    public function select()
    {

        $array = ["Choice 1","Choice 2"];
        return view('test.select', compact('array'));
    }
}
