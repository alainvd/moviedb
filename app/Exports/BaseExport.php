<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

abstract class BaseExport implements FromQuery, WithHeadings
{
    protected Collection $params;

    protected function queryWithParams($query)
    {
        if ($this->params->has('from')) {
            $query->whereDate('dossiers.created_at', '>=', $this->params->get('from'));
        }

        if ($this->params->has('to')) {
            $query->whereDate('dossiers.created_at', '<=', $this->params->get('to'));
        }

        if ($this->params->has('calls')) {
            $query->whereIn('calls.id', $this->params->get('calls'));
        }

        if ($this->params->has('actions')) {
            $query->whereIn('actions.id', $this->params->get('actions'));
        }

        if ($this->params->has('statuses')) {
            $query->whereIn('statuses.id', $this->params->get('statuses'));
        }

        if ($this->params->has('year')) {
            $query->where('calls.year', $this->params->get('year'));
        }

        return $query;
    }
}
