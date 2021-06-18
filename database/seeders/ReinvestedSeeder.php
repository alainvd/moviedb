<?php

namespace Database\Seeders;

use App\Models\Reinvested;
use Illuminate\Database\Seeder;

class ReinvestedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Reinvested::factory()->count(5)->create();
    }
}
