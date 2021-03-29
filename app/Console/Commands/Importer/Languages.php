<?php

namespace App\Console\Commands\Importer;

use App\Imports\LanguagesImport;
use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;

class Languages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:languages';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import Languages';

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
        Excel::import(new LanguagesImport, 'Languages_CCM.xlsx','excel');
    }
}
