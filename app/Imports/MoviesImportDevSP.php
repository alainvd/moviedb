<?php

namespace App\Imports;

use App\Media;
use App\Movie;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MoviesImportDevSP implements ToModel, WithHeadingRow
{

    private function formatDate($date, $id)
    {
        try {
            return \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($date);
        } catch (\ErrorException $e) {
            echo 'Caught exception in date transformation: ', $e->getMessage(), "\n";
            echo 'Movie ID: ', $id, "\n";
            Log::error("Caught exception in date transformation of Movie ID {$id}: " . $e->getMessage());
            return null;
        }


    }

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {

//        dd($row);


        return new Movie([
            'id' => $row['id_code_film'],
            'original_title' => $row['original_title'],
            'logline' => $row['logline'],
            'shooting_start' => $row['first_day_of_principal_photography'] ? $this->formatDate($row['first_day_of_principal_photography'], $row['id_code_film']) : null,
            //'shooting_end' => $row['end_of_shooting_date'] ? $this->formatDate($row['end_of_shooting_date'], $row['id_code_film']) : null,
            'year_of_copyright' => $row['year_of_production'],
            'film_length' => $row['film_length'],
            'number_of_episodes' => $row['number_of_episodes'],
            'length_of_episodes' => $row['length_of_episodes'],
            //'film_format' => $row['film_format'],
            'film_type' => $row['film_type'],
            'film_country_of_origin' => $row['film_country_of_origin'],
            //'film_score' => $row['film_score'],
            //'european_nationality_flag' => $row['european_nationality_flag'],
            //'production_costs_currency_date' => $row['production_costs_currency_date'],
            //'production_costs_currency' => $row['production_costs_currency'],
            //'production_costs' => $row['production_costs'],
            'development_costs_in_euro' => $row['development_costs_in_euro'],
            'production_costs_in_euro' => $row['production_costs_in_euro'],
            'link_applicant_work' => $row['link_applicant_work'],
            'link_applicant_work_person_name' => $row['link_applicant_work_person_name'],
            'link_applicant_work_person_position' => $row['link_applicant_work_person_position'],
            'link_applicant_work_person_credit' => $row['link_applicant_work_person_credit'],            
            //'production_budget_local_currency' => $row['production_budget_local_currency'],


        ]);


    }

}
