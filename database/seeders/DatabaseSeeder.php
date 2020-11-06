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
         $this->call(\Database\Seeders\CallSeeder::class);
         $this->call(\Database\Seeders\SubmissionSeeder::class);
         $this->call(\Database\Seeders\MovieSeeder::class);
         $this->call(\Database\Seeders\VideogameSeeder::class);
         $this->call(\Database\Seeders\MediaSeeder::class);
//         $this->call(\Database\Seeders\MediaSeeder::class);
//         $this->call(\Database\Seeders\MovieSeeder::class);
    }
}
