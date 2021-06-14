<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Fiche;
use App\Models\Movie;
use App\Models\Status;
use App\Models\Dossier;
use App\Models\Activity;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Models\Activity as ActivityLog;

class HistoryController extends Controller
{
    public function index(Dossier $dossier)
    {
        $logs = self::getFormattedLogs($dossier);

        return view('dossiers.history', [
            'backUrl' => route('dossiers.show', $dossier),
            'crumbs' => $this->getCrumbs($dossier),
            'layout' => $this->getLayout(),
            'type' => class_basename($dossier),
            'model' => $dossier,
            'logs' => $logs
        ]);
    }

    public function fiche(Dossier $dossier = null, Activity $activity = null, Fiche $fiche)
    {
        $logs = self::getFormattedLogs($fiche);

        if ($dossier && $activity){
            $crumbs = $this->getCrumbs($dossier);
            $viewHistory = array_pop($crumbs);
            $url = route('dossier-create-fiche', [$dossier, $activity, $fiche]);
            $crumbs[] = [
                'title' => 'Edit fiche',
                'url' => $url
            ];
            $crumbs[] = $viewHistory;
        } else {
            $crumbs = [];
            $viewHistory = array_pop($crumbs);
            $url = route('movie_show', [$fiche]);
            $crumbs[] = [
                'title' => 'Edit fiche',
                'url' => $url
            ];
            $crumbs[] = $viewHistory;
        }

        return view('dossiers.history', [
            'backUrl' => $url,
            'crumbs' => $crumbs,
            'layout' => $this->getLayout(),
            'type' => class_basename($fiche),
            'model' => $fiche,
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
    static public function getFormattedLogs($model)
    {
        $logs = ActivityLog::forSubject($model)->get();

        if (isset($logs[0]->properties['attributes'])) {
            if (isset($logs[0]->properties['attributes']['status_id']))
                $oldStatus = $logs[0]->properties['attributes']['status_id'];
        }
        $oldStatus = isset($oldStatus) ? Status::find($oldStatus)->name : 'Undefined';

        return $logs->map(function ($log) use ($model, &$oldStatus) {
                // Get new status if exists on log, otherwise use old status
                $newStatus = '';
                if (
                    $log->properties->has('attributes')
                    && array_key_exists('status_id', $log->properties['attributes'])
                    && $log->properties['attributes']['status_id']
                ) {
                    $newStatus = $oldStatus = Status::find($log->properties['attributes']['status_id'])->name;
                }

                // Use log description if use_description, else "{$model] {$description}"
                $description = $log->properties->has('use_description')
                    ? $log->description : class_basename($model) . " " . $log->description;
                if ($log->properties->has('model')) {
                    $description = $log->properties['model'] . " " . $log->properties['operation'];
                }

                return [
                    'id' => $log->id,
                    'description' => $description,
                    'user' => $log->causer,
                    'log_date' => $log->created_at,
                    'status' => $newStatus ? $newStatus : $oldStatus,
                    'changes' => $log->properties,
                    'extra' => []
                ];
            });
    }

    protected function getLayout()
    {
        $user = Auth::user();

        /** @var User $user */
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
