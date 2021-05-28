<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Seeder;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $genres = [
            "Movie" => [
                "Fiction", "Animation", "Documentary"
            ],

            "VideoGame" => [
                "Adventure",
                "Role-Playing Game",
                "Action",
                "Strategy",
                "Simulation",
                "Shooter",
                "MMORPG",
            ]
        ];

        foreach ($genres as $key => $values) {

            foreach ($values as $genre_name) {
                Genre::create([
                    "name" => $genre_name,
                    "type" => $key
                ]);
            }
        }
    }
}
