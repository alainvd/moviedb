<?php

namespace App\Http\View\Composers;

use App\Models\Call;
use App\Models\Dossier;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class DashboardComposer
{
    public function compose(View $view)
    {
        $dials = [];
        $colors = ['blue', 'orange', 'purple', 'teal'];
        $actions = ['FILMOVE', 'DEVSLATE', 'CODEV', 'DEVSLATEMINI'];
        $year = date('Y');

        $data = DB::table('dossiers')
            ->join('calls', 'dossiers.call_id', '=', 'calls.id')
            ->join('actions', 'calls.action_id', '=', 'actions.id')
            ->select(DB::raw('count(dossiers.id) as count, actions.name'))
            ->whereIn('actions.name', $actions)
            ->whereRaw("year(calls.published_at) = {$year}")
            ->groupByRaw('year(calls.published_at), actions.name')
            ->get();

        foreach ($actions as $key => $action) {
            $actionData = $data->where('name', $action)->first();
            $dials[] = [
                'label' => "{$action} this year",
                'color' => $colors[$key],
                'data' => $actionData ? $actionData->count : 0,
            ];
        }

        $view->with('dials', $dials);
    }
}
