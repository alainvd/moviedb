<?php

namespace App\Console\Commands\Importer;

use Illuminate\Console\Command;

class Prod extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:prod';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import prod';

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

        $this->call(\Database\Seeders\CountriesTableSeeder::class);
        $this->info("countries seeder ok");

        $this->call(\Database\Seeders\StatusSeeder::class);
        $this->info("status seeder ok");

        $this->call('import:languages'); // Languages.php
        $this->info("languages import ok");

        $this->call('import:actions'); // Actions.php
        $this->info("actions import ok");

        $this->call('import:calls'); // Calls.php
        $this->info("calls import ok");

        $this->call(\Database\Seeders\ActivitySeeder::class);
        $this->info("activity seed ok");

        $this->call(\Database\Seeders\RolesAndPermissionsSeeder::class);
        $this->info("roles and permissions seed ok");

        // TODO: Don't run user seeder in production
        $this->call(\Database\Seeders\UserSeeder::class);
        $this->info("user seed ok");

        $this->call('import:movies-dist'); // MoviesDist.php
        $this->info("movies-dist import ok");
        // $this->call('import:movies-dist'); // MoviesOther.php
        // $this->info("movies-other import ok");

        $this->call('import:genres'); // Genres.php
        $this->info("genre import ok");

        $this->call('import:audiences'); // Audiences.php // Can use seeder as well
        $this->info("audiences import ok");

        // $this->call('import:roles'); // Roles.php // Use seeder instead
        $this->call(\Database\Seeders\TitleSeeder::class); // Seeder has all roles
        $this->info("title seed ok");

        $this->call('import:movies-languages'); // MoviesLanguages.php
        $this->info("movie languages import ok");

        $this->call('import:staff-dist'); // StaffDist.php // takes a long time
        $this->info("staff-dist import ok");
        // $this->call('import:staff-other'); // StaffOther.php // takes a long time
        // $this->info("staff-other import ok");

        $this->call('import:locations-dist'); // LocationsDist.php
        $this->info("locations-dist import ok");
        // $this->call('import:locations-other'); // LocationsOther.php
        // $this->info("locations-other import ok");

        $this->call('import:producers'); // Producers.php // takes a long time
        $this->info("Producers import ok");

        $this->call('import:sa'); // SalesAgents.php
        $this->info("Sales agents import ok");

        // $this->call('import:dossiers'); // Dossiers.php
        // $this->info("dossiers import ok");

        // $this->call('import:activities'); // Activities.php
        // $this->info("activities import ok");
    }
}
