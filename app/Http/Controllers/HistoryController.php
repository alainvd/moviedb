<?php

namespace App\Http\Controllers;

use App\Models\Dossier;
use App\Models\Fiche;
use App\Models\Movie;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Spatie\Activitylog\Models\Activity as ActivityLog;

class HistoryController extends Controller
{
    public function index(Dossier $dossier)
    {
        $logs = $this->getFormattedLogs($dossier);

        return view('dossiers.history', [
            'crumbs' => $this->getCrumbs($dossier),
            'layout' => $this->getLayout(),
            'type' => class_basename($dossier),
            'model' => $dossier,
            'logs' => $logs
        ]);
    }

    /**
     * Get the formatted logs
     * - description
     * - user data
     * - date
     * - status
     * - old ?
     * - changes
     * - extra data: fiche, movie, ...
     */
    protected function getFormattedLogs($model)
    {
        $logs = ActivityLog::forSubject($model)->get();

        $oldStatus = $logs[0]->properties['attributes']['status_id'];
        $oldStatus = Status::find($oldStatus)->name;

        return $logs->map(function ($log) use ($model, &$oldStatus) {
                // Get new status if exists on log, otherwise use old status
                $newStatus = '';
                if ($log->properties->has('attributes')
                    && array_key_exists('status_id', $log->properties['attributes'])) {
                    $newStatus = $oldStatus = Status::find($log->properties['attributes']['status_id'])->name;
                }

                // Use log description if use_description, else "{$model] {$description}"
                $description = $log->properties->has('use_description')
                    ? $log->description : class_basename($model) . " " . $log->description;
                if ($log->properties->has('model')) {
                    $description = $log->properties['model'] . " " . $log->properties['operation'];
                }

                return [
                    'description' => $description,
                    'user' => $log->causer,
                    'log_date' => $log->created_at,
                    'status' => $newStatus ? $newStatus : $oldStatus,
                    'changes' => property_exists('attributes', $log->properties) ? $log->properties['attributes'] : null,
                    'extra' => []
                ];
            });
    }

    protected function getLayout()
    {
        $user = Auth::user();

        if ($user->hasRole('applicant')) {
            return 'ecl-layout';
        }

        return 'layout';
    }

    protected function getCrumbs($model)
    {
        return [
            [
                'url' => route('dossiers.index'),
                'title' => 'My dossiers',
            ],
            [
                'url' => route('dossiers.show', $model),
                'title' => 'Edit dossier',
            ],
            [
                'title' => 'View history',
            ]
        ];
    }
}
