<?php

namespace Database\Seeders;

use App\Audience;
use Illuminate\Database\Seeder;

class AudienceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Audience::factory()->count(5)->create();
    }
}
