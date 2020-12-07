<?php

namespace Database\Seeders;

use App\SalesAgent;
use Illuminate\Database\Seeder;

class SalesAgentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SalesAgent::factory()->count(5)->create();
    }
}
