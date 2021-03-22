<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;

class PICController extends Controller
{
    public function index(Request $request)
    {
        return view('pic.test');
    }
}
