<?php

namespace Database\Seeders;

use App\Media;
use App\Movie;
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

        VideoGame::all()->each(function ($videogame) {
            Media::factory()->create([
                'title' => $videogame->name,
                'grantable_id' => $videogame->id,
                'grantable_type' => "App\Videogame"
            ]);
        });
    }
}
