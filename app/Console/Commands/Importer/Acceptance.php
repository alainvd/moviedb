<?php

namespace App\Console\Commands\Importer;

use Illuminate\Console\Command;

class Acceptance extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:acceptance';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import acceptance';

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
        $this->call('import:languages');
        echo("languages import ok \r\n");
        $this->call('import:actions');
        echo("actions import ok \r\n");
        $this->call('import:calls');
        echo("calls import ok \r\n");
        $this->call(\Database\Seeders\ActivitySeeder::class);
        echo("Activity seed ok \r\n");
        $this->call(\Database\Seeders\RolesAndPermissionsSeeder::class);
        echo("Roles and permissions seed ok \r\n");
        $this->call(\Database\Seeders\UserSeeder::class);
        echo("User seed ok \r\n");

        $this->call(\Database\Seeders\GenreSeeder::class);
        echo("Genre seed ok \r\n");
        $this->call(\Database\Seeders\AudienceSeeder::class);
        echo("Audience seed ok \r\n");

        $this->call(\Database\Seeders\TitleSeeder::class); // Seeder has all roles
        echo("Title seed ok \r\n");

    }
}
