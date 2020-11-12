<?php

namespace Database\Seeders;

use App\Media;
use App\Movie;
use Illuminate\Database\Seeder;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Movie::factory()->count(10)->create();

        Movie::all()->each(function ($movie) {
            Media::factory()->create([
                'title' => $movie->original_title,
                'grantable_id' => $movie->id,
                'grantable_type' => "App\Movie"
            ]);
        });

    }
}
