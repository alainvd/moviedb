<?php

namespace App\Imports;

use App\Models\Movie;
use App\Models\Language;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class LanguagesImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {

        return new Language([
            'name' => $row['name'],
            'code' => $row['code'],
            'position' => $row['position'],
            'active' => 1,
        ]);

    }
}
