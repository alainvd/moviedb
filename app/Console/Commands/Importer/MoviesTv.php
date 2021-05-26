<?php

namespace App\Console\Commands\Importer;

use App\Imports\MoviesImportTV;
use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;

class MoviesTv extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:moviesTv';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import Movies from Excel';

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
        Excel::import(new MoviesImportTV, 'TV_General .xlsx','excel');
    }
}
