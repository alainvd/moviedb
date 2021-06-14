<?php

namespace App\Console\Commands\Importer;

use App\Imports\ActionsImport;
use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;

class Actions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:actions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import Actions';

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
        Excel::import(new ActionsImport, 'Actions.xlsx','excel');
    }
}
