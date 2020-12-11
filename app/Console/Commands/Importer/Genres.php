<?php

namespace App\Console\Commands\Importer;

use App\Imports\AudiencesImport;
use App\Imports\GenresImport;
use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;

class Genres extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:genres';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import Genres';

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
        Excel::import(new GenresImport, 'Dist_Film_Genre.xlsx', 'excel');
    }
}
