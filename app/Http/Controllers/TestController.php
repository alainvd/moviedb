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

        return view('test.select');
    }
}
