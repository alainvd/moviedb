<?php

namespace App\Http\Controllers;

use App\Http\Livewire\MovieDevCurrentForm;
use App\Http\Livewire\MovieDevPrevForm;
use App\Models\Fiche;
use Illuminate\Http\Request;
use App\Http\Livewire\MovieDistForm;
use App\Http\Livewire\MovieTVForm;
use App\Http\Livewire\VideoGamePrevForm;
use Barryvdh\DomPDF\Facade as PDF;

class FicheController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Fiche::find($id)->delete();

        return redirect()->back();
    }

    public function prepareFiche(Fiche $fiche) {

        // TODO: complete this
        switch ($fiche->type) {
            case 'dev-current':
                $f = new MovieDevCurrentForm();
                $title = 'Films - Current work';
                break;
            case 'dev-prev':
                $f = new MovieDevPrevForm();
                $title = 'Films - Previous work';
                break;
            case 'dist':
                $f = new MovieDistForm();
                $title = 'Films - Distribution';
                break;
            case 'tv':
                $f = new MovieTVForm();
                $title = 'Audiovisual Work - Production - TV and Online';
                break;
            case 'vg':
                $f = new VideoGamePrevForm();
                $title = 'Audiovisual Work - Production - Videogames';
                break;
        }
        $rules = $f->rules();
        $layout = 'print-layout';
        $movie = $fiche->movie;
        $isApplicant = true;
        $isEditor = false;
        $shootingLanguages = $movie->languages;
        $print = true;
        $crumbs = [];

        return compact('rules', 'layout', 'movie', 'fiche', 'isApplicant', 'isEditor', 'shootingLanguages', 'print', 'title', 'crumbs');

    }

    public function template(Fiche $fiche) {
        return 'livewire.movie-'.$fiche->type.'-form-with-layout';
    }

    public function printFiche(Fiche $fiche) {

        return view($this->template($fiche), $this->prepareFiche($fiche));

    }

    public function downloadFiche(Fiche $fiche) {

        // dompdf
        $pdf = PDF::loadView($this->template($fiche), $this->prepareFiche($fiche));
        return $pdf->stream();

    }
}
