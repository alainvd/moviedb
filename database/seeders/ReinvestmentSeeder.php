<?php

namespace Database\Seeders;

use App\Models\Reinvestment;
use Illuminate\Database\Seeder;

class ReinvestmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Reinvestment::factory()->count(5)->create();
    }
}
