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
            "DEVMINISLATE",
            "CODEV",
            "DEVVG",
            "DISTSAG",
            "FILMOVE",
            "TVONLINE",
            "DISTAUTOG",
        ];

        foreach ($codes as $code) {
            Action::create([
                'name' => $code
            ]);
        }
    }
}
