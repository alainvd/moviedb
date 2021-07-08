<?php

namespace App\Exports;

use App\Models\Dossier;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Exportable;

class DossiersExport extends BaseExport
{
    use Exportable;

    public function __construct(Collection $params)
    {
        $this->params = $params;
    }

    public function headings(): array
    {
        return [
            'SEP ID',
            'Action',
            'Call',
            'Year',
            'Status',
            'Company',
            'Contact person',
            'Created at',
            'Created by',
        ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function query()
    {
        $query = Dossier::query()
            ->select('project_ref_id', 'actions.name as action_name', 'calls.name as call_name', 'dossiers.year', 'statuses.name as status_name', 'company', 'contact_person', 'dossiers.created_at', 'users.email')
            ->join('statuses', 'statuses.id', '=', 'dossiers.status_id')
            ->join('calls', 'calls.id', '=', 'dossiers.call_id')
            ->join('actions', 'actions.id', '=', 'dossiers.action_id')
            ->join('users', 'users.id', '=', 'dossiers.created_by');

        return $this->queryWithParams($query);
    }
}
