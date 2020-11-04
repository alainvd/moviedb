<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('movies')->insert([
            'id' => 17271,
            'original_title' => "Girl",
            'shooting_start' => Carbon::create(2017, 8, 9),
            'shooting_end' => Carbon::create(2017, 9, 29),
            'year_of_copyright' => 2018,
            'european_nationality_flag' => 'OK',
            'film_country_of_origin' => 'BE',
            'imdb_url'=>'https://www.imdb.com/title/tt8254556/'
        ]);

        DB::table('movies')->insert([
            'id' => 17916,
            'original_title' => "Adults in the Room",
            'shooting_start' => Carbon::create(2019, 3, 5),
            'shooting_end' => Carbon::create(2017, 5, 27),
            'year_of_copyright' => 2019,
            'european_nationality_flag' => 'OK',
            'film_country_of_origin' => 'FR',
            'imdb_url' => 'https://www.imdb.com/title/tt7493370/'
        ]);
    }
}
