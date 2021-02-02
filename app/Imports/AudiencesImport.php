<?php

namespace App\Imports;

use App\Models\Audience;
use App\Models\Movie;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AudiencesImport implements ToCollection, WithHeadingRow
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {

        foreach ($collection as $row) {


            if ($row["film_audience"]) {

                $movie = Movie::where(
                    [
                        "legacy_id" => $row["id_code_film"]
                    ]
                )->first();

                //Get the Audience
                $audience = Audience::firstOrCreate(
                    [
                        "name"=> $row["film_audience"]
                    ],[
                        "type"=> "Movie"
                    ]
                    );

                $movie->update(['audience_id' => $audience->id]);

            }

        }
    }
}
