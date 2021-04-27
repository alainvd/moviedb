<?php

namespace App\Console\Commands\Importer;

use App\Imports\DossiersImportTV;
use App\Imports\DossiersImportDevSP;
use App\Imports\DossiersImportDevSlate;
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

        //Excel::import(new DossiersImportDist, 'Dist_Film_General.xlsx','excel');
        Excel::import(new DossiersImportDevSP, 'DEV_SP_Dossiers.xlsx','excel');
        Excel::import(new DossiersImportDevSlate, 'Dev_Slate_Dossiers.xlsx','excel');
        Excel::import(new DossiersImportTV, 'TV_Dossiers.xlsx','excel');
    }
}
