<?php

namespace App\Console\Commands\Importer;

use App\Imports\LocationsImport;
use App\Imports\LocationsImportTV;
use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;

class Locations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:locations';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Link Staff with movies';

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
        Excel::import(new LocationsImport, 'Dist_Film_Locations.xlsx', 'excel');
        //Excel::import(new LocationsImportTV, 'TV_Locations.xlsx', 'excel');
    }
}
