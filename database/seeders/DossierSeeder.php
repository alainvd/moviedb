<?php


namespace Database\Seeders;


use App\Models\Dossier;
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
        Dossier::factory(40)->create();

    }
}
