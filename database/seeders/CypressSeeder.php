<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CypressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
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
        $this->call(\Database\Seeders\TitleSeeder::class);
    }
}
