<?php

namespace Database\Seeders;

use App\Models\Activity;
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
        Dossier::all()->each(function ($dossier) {
            $dossier->fiches()->attach(
                Fiche::factory()->count(rand(1, 3))
                    ->create(),
                ['activity_id' => Activity::all()->random()->id]
            );
        });
    }
}

/**
 * dossier > fiche > movie
 */
