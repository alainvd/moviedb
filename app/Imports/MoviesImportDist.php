<?php

namespace App\Imports;

use App\Models\Fiche;
use App\Models\Movie;
use App\Models\Country;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MoviesImportDist implements ToCollection, WithHeadingRow
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

    static function getCountryCode($code) {
        if ($code == '-') return NULL;
        if ($code == '') return NULL;
        if ($code == 'GR') return 'EL';
        if ($code == 'GB') return 'UK';
        if (Country::where('code', $code)->get()->isEmpty()) {
            echo "Country code not in reference table: ".$code."\n";
            return null;
        }
        return $code;
    }

    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        foreach ($collection as $row) {
            
            $status = $row['european_nationality_flag'];
            if ($status=="OK" ||  $status=="NOT OK") {
                    $status = 6;
            } 
            elseif ($status=="Under processing"){
                $status = 3;
            } 
            elseif ($status=="Missing information"){
                $status = 7;
            } 
            else {
                $status = 2;
            }

            $film_length = $row['film_length'];
            if (!is_numeric($film_length)) {
                $parts = explode(' ', $film_length);
                if (is_numeric($parts[0])) {
                    $film_length = $parts[0];
                } else {
                    $film_length = null;
                }
            }

            // Create the movie
            $movie = new Movie([
                'genre_id' => $row['film_genre'],
                'audience_id' => $row['film_audience'],
                'delivery_platform' => "CINEMA",
                'film_type' => $row['film_type']?$row['film_type']:"ONEOFF",
                'legacy_id' => $row['id_code_film'],
                'original_title' => $row['original_title'],
                'year_of_copyright' => $row['year_of_copyright'],
                'film_length' => $film_length,
                'film_format' => null,
                'film_type' => "ONEOFF",
                'film_country_of_origin_2014_2020' => $this->getCountryCode($row['film_country_of_origin']),
                'film_country_of_origin' => $this->getCountryCode($row['film_country_of_origin']),
                'photography_start' => $row['start_of_shooting_date'] ? $this->formatDate($row['start_of_shooting_date'], $row['id_code_film']) : null,
                'photography_end' => $row['end_of_shooting_date'] ? $this->formatDate($row['end_of_shooting_date'], $row['id_code_film']) : null,
                'total_budget_currency_code' => $row['production_costs_currency'],
                'total_budget_currency_amount' => $row['production_costs'],
                'total_budget_euro' => $row['production_costs_in_euro'],
            ]);
            $movie->save();
            $fiche = new Fiche([
                'movie_id' => $movie->id,
                'status_id' => $status,
                'created_by' => 3,
                'type' => "dist",
                'comments' => $row['basis_of_euro_nationality'],
            ]);
            $fiche->save();

        }
        echo("Movies DIST import ok\n");
    }

}