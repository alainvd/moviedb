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
            [
                'name' => 'description',
                'actions' => ['DISTSEL', 'DISTSAG'],
            ],
            [
                'name' => 'previous-work',
                'actions' => ['DEVVG', 'DEVSLATE', 'DEVSLATEMINI', 'CODEVELOPMENT'],
            ],
            [
                'name' => 'current-work',
                'actions' => ['DEVVG', 'DEVSLATE', 'DEVSLATEMINI', 'CODEVELOPMENT', 'TV'],
            ],
            [
                'name' => 'distributors',
                'actions' => ['DISTSEL', 'DISTSAG'],
            ],
            [
                'name' => 'short-films',
                'actions' => ['DEVSLATE', 'DEVSLATEMINI']
            ]
        ];

        $rules = [
            'DEVSLATE' => [
                'min_previous_works' => 2,
                'max_previous_works' => 2,
                'min_current_works' => 3,
                'max_current_works' => 5,
                'min_short_films' => 1,
                'max_short_films' => 1,
            ],
            'DEVSLATEMINI' => [
                'min_previous_works' => 1,
                'max_previous_works' => 1,
                'min_current_works' => 2,
                'max_current_works' => 3,
                'min_short_films' => 1,
                'max_short_films' => 1,
            ],
            'CODEVELOPMENT' => [
                'min_previous_works' => 1,
                'max_previous_works' => 1,
                'min_current_works' => 1,
                'max_current_works' => 1,
            ],
            'DEVVG' => [
                'min_previous_works' => 1,
                'min_current_works' => 1,
                'max_current_works' => 1,
            ],
            'DISTSEL' => [
                'movie_count' => 1,
                'min_coordinators' => 1,
                'min_participants' => 7,
                'distinct_distribution_countries' => true,
            ],
            'DISTSAG' => [
                'movie_count' => 1,
            ],
            'TV' => [
                'min_current_works' => 1,
                'max_current_works' => 1,
            ],
        ];

        foreach ($activities as $activity) {
            $newActivity = Activity::create([
                'name' => $activity['name'],
            ]);

            foreach ($activity['actions'] as $action) {
                $model = Action::where('name', $action)->first();
                $model->activities()->attach($newActivity, [
                    'rules' => $rules[$action]
                ]);
            }
        }
    }
}
