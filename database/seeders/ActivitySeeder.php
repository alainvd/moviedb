<?php

namespace Database\Seeders;

use App\Models\Action;
use App\Models\Activity;
use Illuminate\Database\Seeder;

class ActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $activities =[
            'description' => ['DISTSEL', 'DISTSAG'],
            'previous-work' => ['DEVSLATE'],
            'current-work' => ['DEVSLATE'],
            'distributors' => ['DISTSEL'],
        ];

        foreach ($activities as $activity => $actions) {
            $actvt = Activity::create([
                'name' => $activity,
            ]);

            foreach ($actions as $action) {
                $model = Action::where('name', $action)->first();
                $model->activities()->attach($actvt);
            }
        }
    }
}
