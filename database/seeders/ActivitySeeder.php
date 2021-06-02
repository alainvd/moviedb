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
                'log_model' => 'Movie',
                'actions' => ['FILMOVE', 'DISTSAG'],
            ],
            [
                'name' => 'previous-work',
                'log_model' => 'Previous work',
                'actions' => ['DEVVG', 'DEVSLATE', 'DEVMINISLATE', 'CODEV'],
            ],
            [
                'name' => 'current-work',
                'log_model' => 'Current work',
                'actions' => ['DEVVG', 'DEVSLATE', 'DEVMINISLATE', 'CODEV', 'TVONLINE'],
            ],
            [
                'name' => 'distributors',
                'log_model' => 'Distributor',
                'actions' => ['FILMOVE', 'DISTSAG'],
            ],
            [
                'name' => 'short-films',
                'log_model' => 'Short film',
                'actions' => ['DEVSLATE', 'DEVMINISLATE']
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
            'DEVMINISLATE' => [
                'min_previous_works' => 1,
                'max_previous_works' => 1,
                'min_current_works' => 2,
                'max_current_works' => 3,
                'min_short_films' => 1,
                'max_short_films' => 1,
            ],
            'CODEV' => [
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
            'FILMOVE' => [
                'movie_count' => 1,
                // 'min_coordinators' => 1,
                'min_participants' => 8,
                'max_participants' => 8,
                'distinct_distribution_countries' => true,
            ],
            'DISTSAG' => [
                'movie_count' => 1,
            ],
            'TVONLINE' => [
                'min_current_works' => 1,
                'max_current_works' => 1,
            ],
        ];

        foreach ($activities as $activity) {
            $newActivity = Activity::create([
                'name' => $activity['name'],
                'log_model' => $activity['log_model'],
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
