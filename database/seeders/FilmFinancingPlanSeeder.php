<?php

namespace Database\Seeders;

use App\Models\FilmFinancingPlan;
use Illuminate\Database\Seeder;

class FilmFinancingPlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        FilmFinancingPlan::factory()->count(5)->create();
    }
}
