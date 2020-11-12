<?php


namespace Database\Seeders;


use App\Dossier;
use App\Media;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DossierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $count = Media::all()->count();
        Media::all()->each(function ($media) use ($count) {
            $dossier = Dossier::factory()->create();
            $dossier->media()->attach(rand(1, $count));
        });


    }
}
