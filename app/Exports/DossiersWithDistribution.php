<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class DossiersWithDistribution implements WithMultipleSheets
{
    use Exportable;

    protected Collection $params;

    public function __construct(Collection $params)
    {
        $this->params = $params;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function sheets(): array
    {
        return [
            'dossiers' => new DossiersExport($this->params),
            'distribution' => new DistributorsExport($this->params),
        ];
    }
}
