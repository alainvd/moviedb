<?php

namespace Database\Seeders;

use App\Producer;
use Illuminate\Database\Seeder;

class ProducerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Producer::factory()->count(5)->create();
    }
}
