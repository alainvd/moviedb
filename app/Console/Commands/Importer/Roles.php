<?php

namespace App\Console\Commands\Importer;

use App\Imports\MoviesImport;
use App\Imports\RolesImport;
use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;

class Roles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:roles';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import Roles';

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
        Excel::import(new RolesImport, 'Dist_Film_Roles.xlsx','excel');
    }
}
