<?php

namespace App\Http\Controllers;

use App\Models\Movie;

use App\Models\Audience;
use App\Models\Call;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TestController extends Controller
{
    public function index()
    {
        $call = Call::where('status', 'open')->get()->random();
        $randomPic = Http::post('https://ec.europa.eu/info/funding-tenders/opportunities/api/organisation/search.json', [
            'legalName' => 'abad'
        ])->collect()->random()['pic'];

        $sepParams = [
            'call_id' => $call->name,
            'topic' => $call->name,
            'action_type' => $call->action->name,
            'draft_proposal_id' => 'SEP-' . rand(1234567, 987654321),
            'PIC' => $randomPic
        ];

        return view('test.index', compact('sepParams'));
    }

    public function cas()
    {
        dd(cas()->getAttributes());
        return view('test.cas');
    }

    public function select()
    {
        return view('test.select');
    }

    public function movies()
    {
        $movies = Movie::simplePaginate(30);
        return view('test.browse.movies', compact('movies'));
    }

    public function crew()
    {
        $movie = Movie::first();
        return view('test.browse.crew', compact('movie'));
    }

    public function audience()
    {
        $audience = Audience::all();
        return view('test.browse.audience', compact('audience'));
    }
}
