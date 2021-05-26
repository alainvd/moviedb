<?php

namespace App\Console\Commands\Importer;

use App\Imports\MoviesLanguagesImport;
use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;

class MoviesLanguages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:movies-languages';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import Languages for Movies from Excel';

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

        Excel::import(new MoviesLanguagesImport, 'Dist_Film_Languages.xlsx','excel');
        
    }
}
