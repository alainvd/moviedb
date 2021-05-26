<?php

namespace App\Imports;

use App\Models\Producer;
use App\Models\Genre;
use App\Models\Movie;
use App\Models\Person;
use App\Models\Title;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class ProducersImport implements ToCollection, WithHeadingRow, WithChunkReading
{

    public function chunkSize(): int
	{
		return 1000;
	}

    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        foreach ($collection as $row) {

            //Get Movie
            $movie = $this->getMovie($row);

            //Create the Producer
            if ($movie){
                $producer = new Producer([
                    "movie_id" => $movie->id,
                    "role" => $row["film_role_name"],
                    "name" => $row["prod_name"],
                    "city" => $row["prod_city"],
                    "country" => $row["prod_country_code"],
                    "language" => "",
                    "share" => $row["prod_share"],
                ]);
                $producer->save();
            }

        }
    }
    
    private function getMovie($row)
    {
        $filmID = $row["id_code_film"];
        $movie = Movie::where("legacy_id", "=", $filmID)->first();
        return $movie;
    }

}
