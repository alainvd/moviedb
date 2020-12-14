<?php

namespace App\Console\Commands\Importer;

use App\Imports\AudiencesImport;
use App\Imports\MoviesImport;
use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;

class Audiences extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:audiences';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import Audiences';

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

        Excel::import(new AudiencesImport, 'Dist_Film_Audience.xlsx', 'excel');

    }
}
