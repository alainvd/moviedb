<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GamePlatformsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('game_platforms')->insert([
            [
                'name' => 'Windows',
            ],
            [       
                'name' => 'Playstation 4',
            ],
            [
                'name' => 'Playstation 5',
            ],
            [
                'name' => 'Xbox One',
            ],
            [
                'name' => 'Xbox Series',
            ],
            [
                'name' => 'MacOS',
            ],
            [
                'name' => 'Linux',
            ],
        ]);
    }
}
