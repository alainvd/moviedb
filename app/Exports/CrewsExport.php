<?php

namespace App\Exports;

use App\Models\Dossier;
use Maatwebsite\Excel\Concerns\Exportable;

class CrewsExport extends BaseExport
{
    use Exportable;

    protected $columnMap = [
        'SEP-ID' => 'project_ref_id',
        'Movie ID' => 'movies.id',
        'First name' => 'people.firstname',
        'Last name' => 'people.lastname',
        'Gender' => 'people.gender',
        'Nationality 1' => 'people.nationality1',
        'Nationality 2' => 'people.nationality2',
        'Country of residence' => 'people.country_of_residence',
        'Title' => 'titles.name',
        'Points' => 'crews.points',
    ];

    public function __construct($params)
    {
        $this->params = $params;
    }

    public function headings(): array
    {
        return array_keys($this->columnMap);
    }

    public function query()
    {
        $query = Dossier::query()
            ->select(array_values($this->columnMap))
            ->join('actions', 'actions.id', '=', 'dossiers.action_id')
            ->join('calls', 'calls.id', '=', 'dossiers.call_id')
            ->join('dossier_fiche', 'dossiers.id', '=', 'dossier_fiche.dossier_id')
            ->join('fiches', 'dossier_fiche.fiche_id', '=', 'fiches.id')
            ->join('movies', 'fiches.movie_id', '=', 'movies.id')
            ->join('crews', 'movies.id', '=', 'crews.movie_id')
            ->join('people', 'crews.person_id', '=', 'people.id')
            ->join('titles', 'titles.id', '=', 'crews.title_id')
            ->join('statuses', 'statuses.id', '=', 'fiches.status_id')
            // ->join('genres', 'movies.genre_id', '=', 'genres.id')
            // ->join('audiences', 'movies.audience_id', '=', 'audiences.id')
            ->join('users', 'users.id', '=', 'fiches.created_by');

        return $this->queryWithParams($query);
    }
}
