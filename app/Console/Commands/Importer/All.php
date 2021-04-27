<?php

namespace App\Console\Commands\Importer;

use Illuminate\Console\Command;

class All extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:all';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import all';

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
        echo("countries seeder ok \r\n");
        $this->call(\Database\Seeders\StatusSeeder::class);
        echo("status seeder ok \r\n");
        $this->call('import:languages'); // Languages.php
        echo("languages import ok \r\n");
        $this->call('import:actions'); // Actions.php
        echo("actions import ok \r\n");
        $this->call('import:calls'); // Calls.php
        echo("calls import ok \r\n");
        $this->call(\Database\Seeders\ActivitySeeder::class);
        echo("Activity seed ok \r\n");
        $this->call(\Database\Seeders\RolesAndPermissionsSeeder::class);
        echo("Roles and permissions seed ok \r\n");
        $this->call(\Database\Seeders\UserSeeder::class);
        echo("User seed ok \r\n");

        $this->call('import:movies'); // Movies.php
        echo("movies import ok \r\n");
        $this->call('import:genres'); // Genres.php
        echo("genre import ok \r\n");
        $this->call('import:audiences'); // Audiences.php // Can use seeder as well
        echo("audiences import ok \r\n");

        // $this->call('import:roles'); // Roles.php // Use seeder instead
        $this->call(\Database\Seeders\TitleSeeder::class); // Seeder has all roles
        echo("Title seed ok \r\n");
        

        $this->call('import:staff'); // Staff.php // takes a long time
        echo("staff import ok \r\n");
        $this->call('import:locations'); // Locations.php
        echo("locations import ok \r\n");
        $this->call('import:producers'); // Producers.php // takes a long time
        echo("Producers import ok \r\n");
        $this->call('import:sa'); // SalesAgents.php
        echo("Sales agents import ok \r\n");
        $this->call('import:dossiers'); // Dossiers.php
        echo("Dossiers import ok \r\n");
        $this->call('import:activities'); // Activities.php
        echo("Activities import ok \r\n");
        
    }
}
