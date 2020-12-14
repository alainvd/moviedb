<?php

namespace Database\Seeders;

use App\Audience;
use App\Genre;
use App\Media;
use App\Movie;
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
        Movie::factory()->count(50)->create();

    }
}
