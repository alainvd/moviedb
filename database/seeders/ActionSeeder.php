<?php

namespace Database\Seeders;

use App\Models\Call;
use App\Models\Action;
use Illuminate\Database\Seeder;

class ActionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $codes = [
            "DEVSLATE",
            // "DEVSLATEEU",
            "DEVSLATEMINI",
            "CODEVELOPMENT",
            // "DEVSPANI",
            // "DEVSPDOC",
            // "DEVSPFIC",
            "DEVVG",
            // "DISTAUTOG",
            // "DISTAUTOR1",
            // "DISTAUTOR2",
            // "DISTAUTOR3",
            "DISTSAG",
            // "DISTSAR1",
            // "DISTSAR2",
            "DISTSEL",
            "TV",
            "DISTAUTOG"
        ];


        foreach ($codes as $code) {
            Action::create([
                'name' => $code
            ]);

        }

    }
}

