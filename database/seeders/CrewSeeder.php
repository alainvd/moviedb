<?php

namespace Database\Seeders;

use App\Crew;
use App\Movie;
use Illuminate\Database\Seeder;

class CrewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Movie::all()->each(function ($movie) {
            Crew::factory()->count(rand(3, 12))
                ->create([
                    'media_id' => $movie->media->id,
                ]);
        });
    }
}
