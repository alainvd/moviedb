<?php

namespace App\Http\Controllers;

use Asantibanez\LivewireCharts\Models\ColumnChartModel;
use Asantibanez\LivewireCharts\Models\PieChartModel;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $colors = ['#ed3b50', '#5e9af2', '#c64ed9', '#34ade0', '#34e0ad', '#aae034', '#f2ac5c', '#eb3f92', '#282fe0', '#116304', '#9c9602'];
        $dates = CarbonPeriod::create(Carbon::now()->subDays(6), Carbon::now());
        $title = 'Dashboard';

        // dossiers per day
        $dossiersPerDay = DB::table('dossiers')
            ->select(DB::raw("count(*) as count, DATE_FORMAT(created_at, '%Y-%m-%d') as day"))
            ->groupByRaw("DATE_FORMAT(created_at, '%Y-%m-%d')")
            ->whereBetween('created_at', [Carbon::now()->subDay(6), Carbon::now()])
            ->orderBy("day", 'desc')
            ->get();

        $dossiersPerDayChart =
            (new ColumnChartModel())->setTitle('New dossiers per day (last 7 days)')
                ->withoutLegend();
        foreach ($dates as $date) {
            $forDate = $dossiersPerDay->where('day', $date->format('Y-m-d'))->first();
            $dossiersPerDayChart->addColumn($date->format('d M'), $forDate ? $forDate->count : 0, '#5e9af2');
        }

        // applicants per day
        $applicantsPerDay = DB::table('users')
            ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
            ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
            ->select(DB::raw("count(users.id) as count, DATE_FORMAT(users.created_at, '%Y-%m-%d') as day"))
            ->where('roles.name', 'applicant')
            ->whereBetween('users.created_at', [Carbon::now()->subDay(6), Carbon::now()])
            ->groupByRaw("DATE_FORMAT(users.created_at, '%Y-%m-%d')")
            ->orderBy('day', 'desc')
            ->get();

        $applicantsPerDayChart = (new ColumnChartModel())->setTitle('New applicants per day (last 7 days)')
            ->withoutLegend();
        foreach ($dates as $date) {
            $forDate = $applicantsPerDay->where('day', $date->format('Y-m-d'))->first();
            $applicantsPerDayChart->addColumn($date->format('d M'), $forDate ? $forDate->count : 0, '#f5b820');
        }

        // actions pie chart
        $actionsData = DB::table('dossiers')
            ->join('actions', 'dossiers.action_id', '=', 'actions.id')
            ->select(DB::raw("count(dossiers.id) as count, actions.name as action"))
            ->whereYear('dossiers.created_at', date('Y'))
            ->groupBy('actions.name')
            ->get();

        $actionsChart = (new PieChartModel())->setTitle('Dossiers per action (current year)');
        foreach ($actionsData as $item) {
            $color = $colors[array_rand($colors)];
            $colors = array_filter($colors, fn ($item) => $item !== $color);
            // dd($color, $colors);
            $actionsChart->addSlice($item->action, $item->count, $color);
        }

        return view('dashboard.index', compact('actionsChart', 'applicantsPerDayChart', 'dossiersPerDayChart', 'title'));
    }
}
