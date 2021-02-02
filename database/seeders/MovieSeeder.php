<?php

namespace Database\Seeders;

use App\Models\Audience;
use App\Models\Genre;
use App\Models\Language;
use App\Models\Movie;
use Illuminate\Database\Seeder;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Movie::factory()
            ->count(10)->create();


    }
}
