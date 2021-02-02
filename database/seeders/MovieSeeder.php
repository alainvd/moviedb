<?php

namespace Database\Seeders;

use App\Models\Audience;
use App\Models\Genre;
use App\Media;
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

//        Movie::all()->each(function ($movie) {
//            Media::where('grantable_type', 'App\Models\Movie')
//                ->where('grantable_id', $movie->id)
//                ->first()
//                ->update([
//                    'title' => $movie->original_title,
//                    'grantable_id' => $movie->id,
//                    'grantable_type' => "App\Models\Movie",
//                    'audience_id' => Audience::where('type', 'App\Models\Movie')->get()->random()->id,
//                    'genre_id' => Genre::where('type', 'App\Models\Movie')->get()->random()->id,
//                    'delivery_platform_id' => rand(1, 3),
//                ]);
//        });

    }
}
