<?php

namespace App\Console\Commands\Importer;

use App\Imports\DossierImportTV;
use App\Imports\MoviesImportDevSP;
use App\Imports\MoviesImportDevSlate;
use App\Imports\MoviesImportTV;
use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;

class DossiersTv extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:dossiersTv';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import Dossiers from Excel';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        //Excel::import(new MoviesImport, 'Dist_Film_General.xlsx','excel');
        //Excel::import(new MoviesImportDevSP, 'Dev_SP_General_Old.xlsx','excel');
        //Excel::import(new MoviesImportDevSlate, 'Dev_Slate_General.xlsx','excel');
        Excel::import(new DossierImportTV, 'TV_Dossiers.xlsx','excel');
    }
}
