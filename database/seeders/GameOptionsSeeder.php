<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GameOptionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('game_options')->insert([
            [       
                'name' => 'Offline',
            ],
            [
                'name' => 'Online',
            ],
            
        ]);
    }
}
