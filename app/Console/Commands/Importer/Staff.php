<?php

namespace App\Console\Commands\Importer;

use App\Imports\StaffImport;
use App\Imports\StaffImportDevSP;
use App\Imports\StaffImportDevSlate;
use App\Imports\StaffImportTV;
use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;

class Staff extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:staff';

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
        //Excel::import(new StaffImport, 'Dist_Film_Staff.xlsx', 'excel');
        //Excel::import(new StaffImportDevSP, 'Dev_SP_Staff .xlsx', 'excel');
        //Excel::import(new StaffImportDevSlate, 'Dev_Slate_Staff_web_outcomes.xlsx', 'excel');
        Excel::import(new StaffImportTV, 'TV_Staff.xlsx', 'excel');
    }
}
