<?php

namespace App\Exports;

use App\Models\Dossier;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Exportable;

class FichesExport extends BaseExport
{
    use Exportable;

    protected $columnMap = [
        'Call' => 'calls.name as call_name',
        'SEP-ID' => 'project_ref_id',
        'Year' => 'calls.year',
        'Type' => 'activities.name as activity_name',
        'Movie ID' => 'movies.id',
        'ISAN' => 'movies.isan',
        'EIDR' => 'movies.eidr',
        'Original title' => 'movies.original_title',
        'Year of copyright' => 'movies.year_of_copyright',
        'Genre' => 'genres.name as genre_name',
        'Audience' => 'audiences.name as audience_name',
        'Delivery platform' => 'movies.delivery_platform',
        'IMDB url' => 'movies.imdb_url',
        'Status' => 'statuses.name as status_name',
        'Created at' => 'fiches.created_at',
        'Created by' => 'users.email',
        'Synopsis' => 'movies.synopsis',
        'Delivery date' => 'movies.delivery_date',
        'Broadcast date' => 'movies.broadcast_date',
        'Film length' => 'movies.film_length',
        'Nr of episodes' => 'movies.number_of_episodes',
        'Length of episodes' => 'movies.length_of_episodes',
        'Country of origin' => 'movies.film_country_of_origin',
        'Development costs (EUR)' => 'movies.development_costs_in_euro',
        'Film type' => 'movies.film_type',
        'Film format' => 'movies.film_format',
        'Total budget' => 'movies.total_budget_currency_amount',
        'Total budget currency' => 'movies.total_budget_currency_code',
        'Total budget currency rate' => 'movies.total_budget_currency_rate',
        'Total budget (EUR)' => 'movies.total_budget_euro',
        'Development support flag' => 'movies.dev_support_flag',
        'Development support reference' => 'movies.dev_support_reference',
        'Photography start' => 'movies.photography_start',
        'Photography end' => 'movies.photography_end',
        'Country of origin points' => 'movies.country_of_origin_points',
        'User experience' => 'movies.user_experience',
        'Link between applicant and work' => 'movies.link_applicant_work',
        'Name of person for personal credit' => 'movies.link_applicant_work_person_name',
        'Position of person for personal credit' => 'movies.link_applicant_work_person_position',
        'On-screen credit' => 'movies.link_applicant_work_person_credit',
        'Origin of work' => 'movies.rights_origin_of_work',
        'Type of contract with author' => 'movies.rights_contract_type',
        'Start date of ownership' => 'movies.rights_contract_start_date',
        'End date of ownership' => 'movies.rights_contract_end_date',
        'Date of signature of the agreement' => 'movies.rights_contract_signature_date',
        'Name of author' => 'movies.rights_adapt_author_name',
        'Original title (adaptation)' => 'movies.rights_adapt_original_title',
        'Type of contract with the original author' => 'movies.rights_adapt_contract_type',
        'Start date of ownership (adaptation)' => 'movies.rights_adapt_contract_start_date',
        'End date of ownership (adaptation)' => 'movies.rights_adapt_contract_end_date',
        'Contract signature date (adaptation)' => 'movies.rights_adapt_contract_signature_date',
    ];

    public function __construct(Collection $params)
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
            ->join('activities', 'dossier_fiche.activity_id', '=', 'activities.id')
            ->join('movies', 'fiches.movie_id', '=', 'movies.id')
            ->join('statuses', 'statuses.id', '=', 'fiches.status_id')
            ->join('genres', 'movies.genre_id', '=', 'genres.id')
            ->join('audiences', 'movies.audience_id', '=', 'audiences.id')
            ->join('users', 'users.id', '=', 'fiches.created_by');

        return $this->queryWithParams($query);
    }
}
