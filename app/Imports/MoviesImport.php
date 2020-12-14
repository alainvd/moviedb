<?php

namespace App\Imports;

use App\Media;
use App\Movie;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MoviesImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {

//        dd($row);

        try {
            return new Movie([
                'id' => $row['id_code_film'],
                'original_title' => $row['original_title'],
                'shooting_start' => $row['start_of_shooting_date'] ? \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['start_of_shooting_date']) : null,
                'shooting_end' => $row['end_of_shooting_date'] ? \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['end_of_shooting_date']) : null,
                'year_of_copyright' => $row['year_of_copyright'],
                'film_length' => $row['film_length'],
                'film_country_of_origin' => $row['film_country_of_origin_code'],
            ]);
        } catch (\ErrorException $e) {
            echo 'Caught exception in date transformation: ', $e->getMessage(), "\n";
            echo 'Movie ID: ', $row['id_code_film'], "\n";
            Log::error("Caught exception in date transformation of Movie ID {$row['id_code_film']}: " . $e->getMessage());
        }

    }

}
