<?php

namespace Database\Seeders;

use App\Call;
use Illuminate\Database\Seeder;

class CallSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Call::factory()->count(5)->create();
    }
}
