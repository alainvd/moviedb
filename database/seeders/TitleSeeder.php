<?php

namespace Database\Seeders;

use App\Title;
use Illuminate\Database\Seeder;

class TitleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Title::factory()->count(3)->create();
    }
}
