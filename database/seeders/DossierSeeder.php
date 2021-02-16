<?php


namespace Database\Seeders;

use App\Models\Dossier;
use Illuminate\Database\Seeder;

class DossierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Dossier::factory()->count(40)->create();
    }
}
