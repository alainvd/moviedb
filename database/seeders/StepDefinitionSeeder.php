<?php

namespace Database\Seeders;

use App\Models\Action;
use App\Models\StepDefinition;
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

        $eligibility = [
            "DEVSLATE" => [103, 104, 102, 101, 413, 410, 407, 417, 409, 420, 306, 322, 325, 323, 318, 308, 315, 319, 501, 505, 507],
            "DEVSPANI" => [103, 104, 102, 101, 413, 410, 407, 416, 409, 419, 306, 321, 317, 314, 319, 502, 505, 507],
            "DEVSPDOC" => [103, 104, 102, 101, 413, 410, 407, 416, 409, 419, 306, 321, 317, 314, 319, 502, 505, 507],
            "DEVSPFIC" => [103, 104, 102, 101, 413, 410, 407, 416, 409, 419, 306, 321, 317, 314, 319, 502, 505, 507],
            "DEVVG" => [103, 104, 102, 101, 410, 425, 416, 409, 419, 316, 324, 307, 502, 505, 507],
            "DISTAUTOG" => [103, 104, 101, 102, 415, 408, 404, 423, 402, 405, 406, 412, 411, 422, 331, 338, 335, 330, 336, 333, 329, 327, 328, 320, 501, 504, 506, 503, 507],
            "DISTSAG" => [103, 104, 101, 102, 415, 408, 403, 414, 331, 338, 334, 330, 336, 332, 320, 303, 501, 505, 506, 503, 507, 202],
            "FILMOVE" => [103, 104, 101, 102, 415, 408, 421, 401, 424, 331, 338, 334, 330, 336, 326, 305, 302, 337, 310, 501, 505, 506, 503, 507, 201, 203],
            "TVONLINE" => [103, 104, 102, 101, 413, 410, 407, 418, 306, 304, 340, 339, 309, 301, 312, 313, 311, 502, 505, 507]
        ];


        foreach ($eligibility as $action => $steps) {
            $position = 10;
            foreach ($steps as $step_id) {
                StepDefinition::create([
                    'action' => $action,
                    'step_id' => $step_id,
                    'position' => $position
                ]);
                $position += 10;
            }
        }


    }
}
