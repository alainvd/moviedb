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
        $this->call(\Database\Seeders\ActionSeeder::class);
        $this->call(\Database\Seeders\RolesAndPermissionsSeeder::class);
        $this->call(\Database\Seeders\CallSeeder::class);
        $this->call(\Database\Seeders\SubmissionSeeder::class);
        $this->call(\Database\Seeders\MovieSeeder::class);
        $this->call(\Database\Seeders\VideoGameSeeder::class);

        $this->call(\Database\Seeders\DossierSeeder::class);
        $this->call(\Database\Seeders\UserSeeder::class);
        $this->call(\Database\Seeders\StepSeeder::class);
        $this->call(\Database\Seeders\StepDefinitionSeeder::class);
        $this->call(\Database\Seeders\ChecklistSeeder::class);


    }
}
