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
        $this->call(\Database\Seeders\CountriesTableSeeder::class);
        $this->call(\Database\Seeders\StatusSeeder::class);
        $this->call('import:languages'); // Languages.php
        $this->call(\Database\Seeders\ActionSeeder::class);
        $this->call(\Database\Seeders\ActivitySeeder::class);
        $this->call(\Database\Seeders\RolesAndPermissionsSeeder::class);
        $this->call(\Database\Seeders\UserSeeder::class);

        $this->call('import:movies'); // Movies.php
        $this->call('import:genres'); // Genres.php
        $this->call('import:audiences'); // Audiences.php // Can use seeder as well

        // $this->call('import:roles'); // Roles.php // Use seeder instead
        $this->call(\Database\Seeders\TitleSeeder::class); // Seeder has all roles
        $this->call('import:staff'); // Staff.php // takes a long time

        $this->call('import:locations'); // Locations.php
        $this->call('import:producers'); // Producers.php // takes a long time
        $this->call('import:sa'); // SalesAgents.php
    }
}
