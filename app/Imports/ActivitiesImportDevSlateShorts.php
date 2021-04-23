<?php

namespace App\Imports;

use App\Models\Dossier;
use App\Models\Movie;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class ActivitiesImportDevSlateShorts implements ToCollection, WithHeadingRow, WithChunkReading
{

    public function chunkSize(): int
	{
		return 500;
	}

    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        foreach ($collection as $row) {

            //Get Dossier
            $dossier = $this->getDossier($row);

            //Get Media
            $movie = $this->getMovie($row);


            //Create the crew entry
            
            $dossier->fiches()->attach(
               $movie->id,
                ['activity_id' => 5,
                'dossier_id'=>$dossier->id]
            );
            $dossier->save();  

        }

    }

    private function getDossier($row)
    {
        $dossierID = $row["project_reference_number"];
        $dossier = Dossier::where("project_ref_id","=",$dossierID)->first();
        return $dossier;
    }

    private function getMovie($row)
    {
        $filmID = $row["id_code_film"];
        $movie = Movie::where("legacy_id","=",$filmID)->first();
        return $movie;
    }


}
