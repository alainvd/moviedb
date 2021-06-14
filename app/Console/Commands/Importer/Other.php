<?php

namespace App\Console\Commands\Importer;

use Illuminate\Console\Command;

class Other extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:other';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'For content to be imported later on';

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
        ini_set('memory_limit', '-1');

        $this->call('import:movies-other'); // MoviesOther.php
        $this->info("movies-other import ok");

        $this->call('import:staff-other'); // StaffOther.php // takes a long time
        $this->info("staff-other import ok");

        $this->call('import:locations-other'); // LocationsOther.php
        $this->info("locations-other import ok");

        $this->call('import:dossiers'); // Dossiers.php
        $this->info("dossiers import ok");

        $this->call('import:activities'); // Activities.php
        $this->info("activities import ok");
    }
}
