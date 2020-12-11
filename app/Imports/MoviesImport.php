<?php

namespace App\Imports;

use App\Media;
use App\Movie;
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


        return new Movie([
            'id' => $row['id_code_film'],
            'original_title' => $row['original_title'],
        ]);


    }

}
