<?php

namespace App\Imports;

use App\Models\Action;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ActionsImport implements ToModel, WithHeadingRow
{

        /**
        * @param array $row
        *
        * @return \Illuminate\Database\Eloquent\Model|null
        */
        public function model(array $row)
        {
            return new Action([
                'name' => $row['name'],
            ]);
        }   

}
