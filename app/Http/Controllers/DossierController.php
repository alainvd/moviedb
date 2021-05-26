<?php

namespace App\Http\Controllers;

use App\Models\Dossier;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Meneses\LaravelMpdf\LaravelMpdf as LaravelMpdf;

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
            'FILMOVE' => 'Films on the Move',
            'DISTSAG' => 'European Sales Support',
            'DEVSLATE' => 'European Slate Development',
            'DEVMINISLATE' => 'European Mini-slate Development',
            'CODEV' => 'European Co-development',
            'TVONLINE' => 'TV and Online Content',
            'DEVVG' => 'Videogame development'
        ];
        $print = true;

        return compact('crumbs', 'dossier', 'layout', 'pageTitles', 'print');

    }

    public function printDossier(Dossier $dossier) {

        return view('dossiers.create', $this->prepareDossier($dossier));

    }

    public function downloadFullDossier(Dossier $dossier) {

        ini_set("pcre.backtrack_limit", "5000000");

        $output = $this->printDossier($dossier);

        // get related fiches
        // html output
        /*
        $fiches = $dossier->fiches;
        foreach ($fiches as $fiche) {
            $output .= FicheController::printFiche($fiche);
        }
        return $output;
        */

        // mpdf output page by page
        $output_dossier = $this->printDossier($dossier);

        // get related fiches
        $fiches = $dossier->fiches;

        $output_fiches = [];
        foreach ($fiches as $fiche) {
            $output_fiches[] = FicheController::printFiche($fiche);
        }

        $margin_left = 20;
        $margin_right = 20;
        $margin_top = 25;
        $margin_bottom = 25;
        $margin_header = 10;
        $margin_footer = 10;
        $pdf = new LaravelMpdf('', [
            'margin_left' => $margin_left,
            'margin_right' => $margin_right,
            'margin_top' => $margin_top,
            'margin_bottom' => $margin_bottom,
            'margin_header' => $margin_header,
            'margin_footer' => $margin_footer,
        ]);
        date_default_timezone_set('Europe/Brussels');

        $pdf->getMpdf()->setTitle('Dossier');
        $pdf->getMpdf()->SetHTMLHeader('PDF download of dossier, {DATE d.m.Y. H:i:s}', 0, 1);
        $pdf->getMpdf()->SetHTMLFooter('Page {PAGENO}', 0, 1);
        $pdf->getMpdf()->WriteHTML($output_dossier);
        foreach($output_fiches as $output_fiche) {
            $pdf->getMpdf()->AddPage('P','','','','',$margin_left,$margin_right,$margin_top,$margin_bottom,$margin_header,$margin_footer);
            $pdf->getMpdf()->WriteHTML($output_fiche);
        }

        return $pdf->download('dossier-'.$dossier->project_ref_id.'.pdf');

    }

}
