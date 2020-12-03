<?php

namespace Database\Seeders;

use App\Audience;
use App\Genre;
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
        Movie::factory()->count(50)->create();

        Movie::all()->each(function ($movie) {
            Media::factory()->create([
                'title' => $movie->original_title,
                'grantable_id' => $movie->id,
                'grantable_type' => "App\Movie",
                'audience_id' => Audience::all()->random()->id,
                'genre_id' => Genre::where('type', 'App\Movie')->get()->random()->id,
            ]);
        });

    }
}
