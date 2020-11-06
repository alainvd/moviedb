<?php

namespace App\Http\Controllers;

use App\Interfaces\Grantable;
use App\Media;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $medium = Media::all();

        foreach ($medium as $media){
            dump($this->getDetails($media->grantable));
        }

        return view('media.index', compact('medium'));
    }

    public function getDetails(Grantable $media){
        return $media->whoami();
    }
}
