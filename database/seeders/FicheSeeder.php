<?php

namespace Database\Seeders;

use App\Models\Dossier;
use App\Models\Fiche;
use App\Models\Movie;
use Illuminate\Database\Seeder;

class FicheSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Movie::all()->each(function ($movie) {
            Fiche::factory()->create([
                'movie_id' => $movie->id,
                'dossier_id' => Dossier::all()->random()->id,
            ]);
        });
    }
}
