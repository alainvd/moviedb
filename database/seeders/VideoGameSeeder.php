<?php

namespace Database\Seeders;

use App\Media;
use App\Models\Movie;
use App\VideoGame;
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
         VideoGame::factory()->count(10)->create();


    }
}
