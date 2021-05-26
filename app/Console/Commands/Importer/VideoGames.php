<?php

namespace App\Console\Commands\Importer;

use App\Imports\VideoGamesImport;
use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;

class VideoGames extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:videogames';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import Video Games from Excel';

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
        Excel::import(new VideoGamesImport, 'Dev_Video_Games_General.xlsx','excel');
    }
}
