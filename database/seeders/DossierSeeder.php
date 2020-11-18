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
            $rand = rand(1,5);
            for($cpt=0;$cpt<$rand;$cpt++){
                $dossier->media()->attach(rand(1, $count));
            }

        });


    }
}
