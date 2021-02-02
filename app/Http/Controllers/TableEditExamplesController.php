<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class TableEditExamplesController extends Controller
{
    public function examples(Request $request)
    {
        return view('examples.table-edit-examples', ['movie_id' => Movie::first()->id]);
    }
}
