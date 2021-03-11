<?php

namespace App\Http\Controllers;

use App\Models\Dossier;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;

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

        // dompdf
        $pdf = PDF::loadView('dossiers.create', $this->prepareDossier($dossier));
        return $pdf->stream();

    }
    
}
