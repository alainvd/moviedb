<?php

namespace Database\Seeders;

use App\Models\Action;
use App\StepDefinition;
use Illuminate\Database\Seeder;

class StepDefinitionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $devslate = [
            103, 104, 102, 101, 413, 410, 407, 417, 409, 420, 306, 322, 325, 323, 318, 308, 315, 319, 501, 505, 507
        ];

        $position = 10;
        foreach ($devslate as $step_id) {
            StepDefinition::create([
                'action' => "DEVSLATE",
                'step_id' => $step_id,
                'position' => $position
            ]);
            $position+=10;

        }
    }
}
