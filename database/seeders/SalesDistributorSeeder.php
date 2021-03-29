<?php

namespace Database\Seeders;

use App\Models\SalesDistributor;
use Illuminate\Database\Seeder;

class SalesDistributorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SalesDistributor::factory()->count(5)->create();
    }
}
