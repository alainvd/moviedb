<?php

namespace Database\Seeders;

use App\Videogame;
use Illuminate\Database\Seeder;

class VideogameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Videogame::factory()->count(5)->create();
    }
}
