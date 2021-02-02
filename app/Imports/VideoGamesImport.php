<?php

namespace App\Imports;

use App\Media;
use App\Models\VideoGame;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class VideoGamesImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {


        return new VideoGame([
            'id' => $row['id'],
            'original_title' => $row['original_title'],
            'logline' => $row['logline'],

        ]);


    }

}
