<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        activity()->disableLogging();

        $this->call(\Database\Seeders\AudienceSeeder::class);
        $this->call(\Database\Seeders\GenreSeeder::class);
        $this->call(\Database\Seeders\CountrySeeder::class);
        $this->call(\Database\Seeders\StatusSeeder::class);
        $this->call(\Database\Seeders\LanguageSeeder::class);

        $this->call(\Database\Seeders\RolesAndPermissionsSeeder::class);
        $this->call(\Database\Seeders\UserSeeder::class);

        $this->call(\Database\Seeders\ActionSeeder::class);
        $this->call(\Database\Seeders\ActivitySeeder::class);
        $this->call(\Database\Seeders\CallSeeder::class);
        $this->call(\Database\Seeders\DossierSeeder::class);
        $this->call(\Database\Seeders\FicheSeeder::class);
        $this->call(\Database\Seeders\MovieSeeder::class);
        $this->call(\Database\Seeders\VideoGameSeeder::class);

        $this->call(\Database\Seeders\StepSeeder::class);
        $this->call(\Database\Seeders\StepDefinitionSeeder::class);
        $this->call(\Database\Seeders\ChecklistSeeder::class);

        $this->call(\Database\Seeders\TitleSeeder::class);
        $this->call(\Database\Seeders\PersonSeeder::class);
        $this->call(\Database\Seeders\CrewSeeder::class);
        $this->call(\Database\Seeders\LocationSeeder::class);

        $this->call(\Database\Seeders\ProducerSeeder::class);
        $this->call(\Database\Seeders\SalesAgentSeeder::class);
        $this->call(\Database\Seeders\SalesDistributorSeeder::class);
        $this->call(\Database\Seeders\DocumentSeeder::class);
    }
}
