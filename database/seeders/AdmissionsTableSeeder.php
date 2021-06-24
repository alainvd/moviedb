<?php

namespace Database\Seeders;

use App\Models\AdmissionsTable;
use Illuminate\Database\Seeder;

class AdmissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AdmissionsTable::factory()->count(5)->create();
    }
}
