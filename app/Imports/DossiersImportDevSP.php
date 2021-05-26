<?php

namespace App\Imports;

use App\Models\Dossier;
use App\Models\Fiche;
use App\Models\Activity;
use App\Models\Movie;
use App\Models\Person;
use App\Models\Title;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class DossiersImportDevSP implements ToCollection, WithHeadingRow, WithChunkReading
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

            //Get Movie
            $movie = $this->getMovie($row);

            //Create the Dossier
            $dossier = new Dossier([
                'call_id' => 1,
                'action_id' => 3,
                'status_id' => 11,
                'year' => $row["year"],
                'project_ref_id' => $row["application_reference_number"],
                'company' => $row["applicant"],
                'contact_person' => 'n/a',
                'created_by' => 1,
            ]);
            $dossier->save();
            $dossier->fiches()->attach(
               $movie->id,
                ['activity_id' => 3,
                'dossier_id'=>$dossier->id]
            );
            $dossier->save();  

        }

    }
   
    private function getMovie($row)
    {
        $filmID = $row["id_code_film"];
        echo($filmID);
        $movie = Movie::where("legacy_id","=",$filmID)->first();
        return $movie;
    }

}
