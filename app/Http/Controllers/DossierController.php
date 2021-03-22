<?php

namespace App\Http\Controllers;

use App\Models\Dossier;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
<<<<<<< HEAD
use Illuminate\Support\Facades\App;
=======
use Illuminate\Support\Facades\Auth;
>>>>>>> 78e23f3 (Activity log and dossier history page)

class DossierController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $dossiers = Dossier::all();

        return view('dossier.index', compact('dossiers'));

    }

    public function prepareDossier(Dossier $dossier) {

        // TODO: complete this
        $crumbs = [];
        $layout = 'print-layout';
        $pageTitles = [
            'DISTSEL' => 'Films on the Move',
            'DISTSAG' => 'European Sales Support',
            'DEVSLATE' => 'European Slate Development',
            'DEVSLATEMINI' => 'European Mini-slate Development',
            'CODEVELOPMENT' => 'European Co-development',
            'TV' => 'TV and Online Content',
            'DEVVG' => 'Videogame development'
        ];
        $print = true;

        return compact('crumbs', 'dossier', 'layout', 'pageTitles', 'print');

    }

    public function printDossier(Dossier $dossier) {

        return view('dossiers.create', $this->prepareDossier($dossier));

    }

    public function downloadDossier(Dossier $dossier) {

        activity()->on($dossier)
            ->by(Auth::user())
            ->withProperty('use_description', true)
            ->log('PDF Downloaded');
        // dompdf
        $pdf = PDF::loadView('dossiers.create', $this->prepareDossier($dossier));
        return $pdf->stream();

    }

    public function downloadFullDossier(Dossier $dossier) {

        $output = $this->printDossier($dossier);

        // get related fiches
        $fiches = $dossier->fiches;
        foreach ($fiches as $fiche) {
            $output .= FicheController::printFiche($fiche);
        }

        // html output
        // return $output;

        // pdf output
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($output);
        return $pdf->stream();

    }

}
