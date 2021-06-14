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
        $this->info("countries seeder ok");

        $this->call(\Database\Seeders\StatusSeeder::class);
        $this->info("status seeder ok");

        $this->call('import:languages');
        $this->info("languages import ok");

        $this->call('import:actions');
        $this->info("actions import ok");

        $this->call('import:calls');
        $this->info("calls import ok");

        $this->call(\Database\Seeders\ActivitySeeder::class);
        $this->info("activity seed ok");

        $this->call(\Database\Seeders\RolesAndPermissionsSeeder::class);
        $this->info("roles and permissions seed ok");

        $this->call(\Database\Seeders\UserSeeder::class);
        $this->info("user seed ok");

        $this->call(\Database\Seeders\GenreSeeder::class);
        $this->info("genre seed ok");

        $this->call(\Database\Seeders\AudienceSeeder::class);
        $this->info("audience seed ok");

        $this->call(\Database\Seeders\TitleSeeder::class); // Seeder has all roles
        $this->info("title seed ok");
    }
}
