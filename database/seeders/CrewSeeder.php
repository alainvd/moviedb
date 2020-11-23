<?php

namespace Database\Seeders;

use App\Crew;
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
        Crew::factory()->count(5)->create();
    }
}
