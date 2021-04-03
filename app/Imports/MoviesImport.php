<?php

namespace App\Imports;


use App\Models\Movie;
use App\Models\Fiche;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MoviesImport implements ToCollection, WithHeadingRow
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
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        foreach ($collection as $row) {
            
            //Create the crew entry
            $movie = new Movie([
                'genre_id' => $row['film_genre'],
                'audience_id' => $row['film_audience'],
                'delivery_platform' => "CINEMA",
                'film_type' => $row['film_type']?$row['film_type']:"ONEOFF",
                'legacy_id' => $row['id_code_film'],
                'original_title' => $row['original_title'],
                'year_of_copyright' => $row['year_of_copyright'],
                'film_length' => $row['film_length'],
                'film_format' => $row['film_format'],
                'film_type' => $row['film_type'],
                'film_country_of_origin_2014_2020' => $row['film_country_of_origin'],
                'film_country_of_origin' => $row['film_country_of_origin'],
                'photography_start' => $row['start_of_shooting_date'] ? $this->formatDate($row['start_of_shooting_date'], $row['id_code_film']) : null,
                'photography_end' => $row['end_of_shooting_date'] ? $this->formatDate($row['end_of_shooting_date'], $row['id_code_film']) : null,
                'total_budget_currency_code' => $row['production_costs_currency'],
                'total_budget_currency_amount' => $row['production_costs'],
                'total_budget_euro' => $row['production_costs_in_euro'],
            ]);
            $movie->save();
            $fiche = new Fiche([
                'movie_id' => $movie->id,
                'status_id' => 3,
                'created_by' => 1,
                'type' => "dist",
            ]);
            $fiche->save();

        }

    }

    

}
