<?php

namespace App\Console\Commands\Importer;

use App\Imports\ActivitiesImportDevSlate;
use App\Imports\ActivitiesImportDevSlateShorts;
use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;

class Activities extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:activities';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import Activities';

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
        Excel::import(new ActivitiesImportDevSlate, 'Dev_Slate_Activities.xlsx','excel');
        Excel::import(new ActivitiesImportDevSlateShorts, 'Dev_Slate_Activities_Shorts.xlsx','excel');
    }
}
