<?php

namespace Database\Seeders;

use App\Videogame as VideoGame;
use Illuminate\Database\Seeder;

class VideoGameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        VideoGame::factory()->count(5)->create();
    }
}
