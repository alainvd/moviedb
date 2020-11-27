<?php

namespace Database\Seeders;

use App\Genre;
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
            "App\Movie" => [
                "Fiction", "Creative Documentary","Animation","Live-Action Children Film"
            ],

            "App\Videogame" => [
                "Adventure",
                "Role-Playing Game",
                "Action",
                "Strategy",
                "Simulation"
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