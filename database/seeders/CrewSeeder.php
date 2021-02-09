<?php

namespace Database\Seeders;

use App\Models\Crew;
use App\Models\Movie;
use App\Models\Title;
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
            // Add one director
            Crew::factory()
                ->for(Title::factory()->state([
                    'code' => 'DIRECTOR',
                ]))
                ->create([
                    'movie_id' => $movie->id,
                ]);

            // Add random crews
            Crew::factory()->count(rand(3, 12))
                ->create([
                    'movie_id' => $movie->id
                ]);
        });
    }
}
