<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function cas()
    {
        dump(cas()->user());
        dump(cas()->getAttributes());
    }
}
