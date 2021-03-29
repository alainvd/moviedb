<?php

namespace App\Console\Commands\Importer;

use App\Imports\ProducersImport;
use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;

class Producers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:producers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Link Producer with movies';

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
        Excel::import(new ProducersImport, 'Dist_Film_Prod.xlsx', 'excel');
        //Excel::import(new ProducersImportDevSP, 'Dev_SP_Prod.xlsx', 'excel');
    }
}
