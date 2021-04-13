<?php

namespace Database\Seeders;

use App\Models\AdmissionFilm;
use Illuminate\Database\Seeder;

class AdmissionFilmSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AdmissionFilm::factory()->count(5)->create();
    }
}
