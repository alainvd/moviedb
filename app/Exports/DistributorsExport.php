<?php

namespace App\Exports;

use App\Models\Dossier;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;

class DistributorsExport extends BaseExport
{
    use Exportable;

    protected $columnMap = [
        'SEP-ID' => 'project_ref_id',
        'Movie ID' => 'movies.id',
        'Original Title' => 'movies.original_title',
        'Company' => 'distributors.name as company',
        'Role' => 'distributors.role',
        'Country' => 'countries.name as country',
        'Forecast Release Date' => 'distributors.forecast_release_date',
        'Forecast Grant' => 'distributors.forecast_grant',
        'P&A Costs' => 'distributors.pa_costs',
        'Added by' => 'users.email',
        'Added at' => 'distributors.created_at',
    ];

    public function __construct($params)
    {
        $this->params = $params;
    }

    public function headings(): array
    {
        return array_keys($this->columnMap);
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function query()
    {
        $query = Dossier::query()
            ->select(array_values($this->columnMap))
            ->join('actions', 'actions.id', '=', 'dossiers.action_id')
            ->join('calls', 'calls.id', '=', 'dossiers.call_id')
            ->join('dossier_fiche', 'dossiers.id', '=', 'dossier_fiche.dossier_id')
            ->join('fiches', 'dossier_fiche.fiche_id', '=', 'fiches.id')
            ->join('movies', 'fiches.movie_id', '=', 'movies.id')
            ->join('distributor_movie', 'movies.id', '=', 'distributor_movie.movie_id')
            ->join('distributors', 'distributor_movie.distributor_id', '=', 'distributors.id')
            ->join('countries', 'distributors.country_id', '=', 'countries.id')
            ->join('users', 'distributors.created_by', '=', 'users.id');

        return $this->queryWithParams($query);
    }
}
