<?php

namespace App\Imports;

use App\Media;
use App\Movie;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MoviesImport implements ToModel, WithHeadingRow
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
            'shooting_start' => $row['start_of_shooting_date'] ? $this->formatDate($row['start_of_shooting_date'], $row['id_code_film']) : null,
            'shooting_end' => $row['end_of_shooting_date'] ? $this->formatDate($row['end_of_shooting_date'], $row['id_code_film']) : null,
            'year_of_copyright' => $row['year_of_copyright'],
            'film_length' => $row['film_length'],
            'film_country_of_origin' => $row['film_country_of_origin_code'],
        ]);


    }

}
