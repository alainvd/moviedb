<?php

namespace Database\Seeders;

use App\Audience;
use App\StepDefinition;
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
        $audiences = [
            "App\Movie" => [
                "Children", "Adults", "Action", "Comedy", "Animation", "Dark Comedy", "Drama", "Thriller", "Adventure", "Historical", "Fantasy", "Cyber Punk", "Romance"
            ],
            "App\Videogame" => [
                "PEGI OK", "PEGI 3", "PEGI 7", "PEGI 12", "PEGI 16", "PEGI 18", "Action", "Shooter", "RPG", "MMORPG", "Stratey", "Adventure"
            ]
        ];

        foreach ($audiences as $key => $values) {

            foreach ($values as $audience_name) {
                Audience::create([
                    "name" => $audience_name,
                    "type" => $key
                ]);
            }
        }

    }
}
