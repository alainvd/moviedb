<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Media;

class TableEditExamplesController extends Controller
{
    public function examples(Request $request)
    {
        return view('examples.table-edit-examples', ['media_id' => Media::first()->id]);
    }
}
