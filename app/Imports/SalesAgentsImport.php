<?php

namespace App\Imports;

use App\Models\SalesAgent;
use App\Models\Movie;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class SalesAgentsImport implements ToCollection, WithHeadingRow, WithChunkReading
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

             

            //Create the Sales Agent
            $producer = new SalesAgent([
                "movie_id" => $movie->id,
                "role" => $row["film_role_name"],
                "name" => $row["sales_agent_name"],
                "country" => $row["sales_agent_nationality_1_code"],

                
            ]);
            $producer->save();

        }

    }
   
    private function getMovie($row)
    {
        $filmID = $row["id_code_film"];
        $movie = Movie::where("legacy_id","=",$filmID)->first();
        return $movie;
    }


}
