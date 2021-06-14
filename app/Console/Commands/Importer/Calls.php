<?php

namespace App\Console\Commands\Importer;

use App\Imports\CallsImport;
use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;

class Calls extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:calls';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import Calls';

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
        Excel::import(new CallsImport, 'Calls.xlsx','excel');
    }
}
