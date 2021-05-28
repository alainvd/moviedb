<?php

namespace App\Imports;

use App\Models\Movie;
use App\Models\Fiche;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MoviesImportTV implements ToCollection, WithHeadingRow
{

    public function chunkSize(): int
	{
		return 500;
	}

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
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        foreach ($collection as $row) {

            // Create the movie
            $movie = new Movie([
                'genre_id' => $row['film_genre'],
                'legacy_id' => $row['id_code_film'],
                'original_title' => $row['application_title'],
                'delivery_platform' => "TV",
                //'synopsis' => $row['logline'],
                'photography_start' => $row['first_day_of_principal_photo_all'] ? $this->formatDate($row['first_day_of_principal_photo_all'], $row['id_code_film']) : null,
                //'year_of_copyright' => $row['year_of_production'],
                'film_length' => $row['total_duration_in_minutes_all'],
                'number_of_episodes' => $row['nr_of_episodes'],
                'length_of_episodes' => $row['length_of_episodes'],
                'film_type' => $row['type'],
                //'film_country_of_origin' => $row['country_code'],
                'development_costs_in_euro' => $row['application_budget'],
                //'total_budget_euro' => $row['production_costs_in_euro'],
                //'rights_origin_of_work'=> $row['rights_origin_of_work'],
                //'rights_contract_type'=> $row['rights_contract_type'],
                //'rights_contract_start_date' => $row['rights_contract_start_date']? $this->formatDate($row['rights_contract_start_date'], $row['id_code_film']) : null,
                //'rights_contract_end_date' => $row['rights_contract_end_date']? $this->formatDate($row['rights_contract_end_date'], $row['id_code_film']) : null,
                //'rights_contract_signature_date' => $row['rights_contract_signature_date']? $this->formatDate($row['rights_contract_signature_date'], $row['id_code_film']) : null,
                //'rights_adapt_author_name'=> $row['rights_origin_of_work'],
                //'rights_adapt_original_title' => $row['rights_adapt_original_title'],
                //'rights_adapt_contract_type' => $row['rights_adapt_contract_type'],
                //'rights_adapt_contract_start_date' => $row['rights_adapt_contract_start_date']? $this->formatDate($row['rights_adapt_contract_start_date'], $row['id_code_film']) : null,
                //'rights_adapt_contract_end_date' => $row['rights_adapt_contract_end_date']? $this->formatDate($row['rights_adapt_contract_end_date'], $row['id_code_film']) : null,
                //'rights_adapt_contract_signature_date' => $row['rights_adapt_contract_signature_date']? $this->formatDate($row['rights_adapt_contract_signature_date'], $row['id_code_film']) : null,
            ]);

            $movie->save();
            $fiche = new Fiche([
                'movie_id' => $movie->id,
                'status_id' => 3,
                'created_by' => 1,
                'type' => "tv",
            ]);
            $fiche->save();

        }
        echo("Movies TV import ok\n");
    }

}
