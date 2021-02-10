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
                ->for(Title::where('code', 'DIRECTOR')->first())
                ->create([
                    'movie_id' => $movie->id,
                ]);

            // Add random crews
            Crew::factory()
                ->count(rand(3, 12))
                ->for(Title::where('code', '!=', 'DIRECTOR')->get()->random())
                ->create([
                    'movie_id' => $movie->id
                ]);
        });
    }
}
