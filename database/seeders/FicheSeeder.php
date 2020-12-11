<?php

namespace Database\Seeders;

use App\Dossier;
use App\Media;
use App\Models\Fiche;
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
        Media::all()->each(function ($media) {
            Fiche::factory()->create([
                'media_id' => $media->id,
                'dossier_id' => Dossier::all()->random()->id,
            ]);
        });
    }
}
