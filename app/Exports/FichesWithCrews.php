<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class FichesWithCrews implements WithMultipleSheets
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
            'fiches' => new FichesExport($this->params),
            'cast' => new CrewsExport($this->params),
        ];
    }
}
