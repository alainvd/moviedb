<?php

namespace App\Console\Commands\Importer;

use App\Imports\StaffImportDevSP;
use App\Imports\StaffImportDevSlate;
use App\Imports\StaffImportTV;
use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;

class StaffOther extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:staff-other';

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
        Excel::import(new StaffImportDevSP, 'Dev_SP_Staff_2015_2016.xlsx', 'excel');
        Excel::import(new StaffImportDevSP, 'Dev_SP_Staff_2017_2020.xlsx', 'excel');
        Excel::import(new StaffImportDevSlate, 'Dev_Slate_Staff_2015_2016.xlsx', 'excel');
        Excel::import(new StaffImportDevSlate, 'Dev_Slate_Staff_2017_2020.xlsx', 'excel');
        Excel::import(new StaffImportTV, 'TV_Staff_2014_2016.xlsx', 'excel');
        Excel::import(new StaffImportTV, 'TV_Staff_2017_2020.xlsx', 'excel');
    }
}
