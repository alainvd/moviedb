<?php

namespace App\Console\Commands\Importer;

use App\Imports\StaffImportDist;
use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;

class StaffDist extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:staff-dist';

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
        Excel::import(new StaffImportDist, 'Dist_Film_Staff.xlsx', 'excel');
    }
}
