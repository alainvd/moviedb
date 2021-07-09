<?php

namespace App\Http\Controllers;

use App\Models\Fiche;
use App\Models\Dossier;
use Illuminate\Http\Request;
use App\Http\Livewire\MovieTVForm;
use App\Http\Livewire\MovieDistForm;
use App\Http\Livewire\MovieDevPrevForm;
use App\Http\Livewire\VideoGamePrevForm;
use App\Http\Livewire\MovieDevCurrentForm;
use Meneses\LaravelMpdf\Facades\LaravelMpdf as LaravelMpdf;

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
        //
    }

    public static function prepareFiche(Fiche $fiche) {

        // TODO: complete this
        switch ($fiche->type) {
            case 'dev-current':
                $f = new MovieDevCurrentForm();
                break;
            case 'dev-prev':
                $f = new MovieDevPrevForm();
                break;
            case 'dist':
                $f = new MovieDistForm();
                break;
            case 'tv':
                $f = new MovieTVForm();
                break;
            case 'vg':
                $f = new VideoGamePrevForm();
                break;
        }
        $title = $fiche->ficheTypeTitle();
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

    public static function template(Fiche $fiche) {
        return 'livewire.movie-'.$fiche->type.'-form-with-layout';
    }

    public static function printFiche(Fiche $fiche) {
        return view(self::template($fiche), self::prepareFiche($fiche));
    }

    public static function downloadFiche(Fiche $fiche) {
        // mpdf
        $pdf = LaravelMpdf::loadView(self::template($fiche), self::prepareFiche($fiche));
        return $pdf->stream();
    }

    public function ficheDossiers(Fiche $fiche) {
        $tab = 'dossiers';
        $title = $fiche->ficheTypeTitle();
        $movie = $fiche->movie;
        $dossiers = $fiche->dossiers;
        return view('components.details.fiche-dossiers', compact('tab', 'title', 'movie', 'fiche', 'dossiers'));
    }
}
