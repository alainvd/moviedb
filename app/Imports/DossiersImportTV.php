<?php

namespace App\Imports;

use App\Models\Dossier;
use App\Models\Movie;
use App\Models\Person;
use App\Models\Title;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class DossiersImportTV implements ToCollection, WithHeadingRow, WithChunkReading
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

            // Get Movie
            $movie = $this->getMovie($row);

            // Create the dossier
            $dossier = new Dossier([
                'call_id' => 1,
                'action_id' => 7,
                'status_id' => 11,
                'year' => $row["year"],
                'project_ref_id' => $row["application_reference_number"],
                'company' => $row["applicant"],
                'contact_person' => 'n/a',
                'created_by' => 1,
            ]);
            $dossier->save();

            // Add movie to dossier
            $dossier->fiches()->attach(
               $movie->id,
                ['activity_id' => 3,
                'dossier_id' => $dossier->id]
            );
            $dossier->save();

        }
    }

    private function getTitle($row)
    {
        return Title::firstWhere("name", "=", $row["role_name"]);
    }

    private function getMovie($row)
    {
        $filmID = $row["id_code_film"];
        echo($filmID."\n");
        $movie = Movie::where("legacy_id", "=", $filmID)->first();
        return $movie;
    }

    public function getFirstName($fullname)
    {
        return explode(" ", $fullname)[0];
    }

    public function getLastName($fullname, $firstname)
    {
        return substr($fullname, strlen($firstname) + 1);
    }

    /**
     * @param $actor
     */
    public function getActivity($row): Person
    {
        $fullName = $row["name"]->trim();
        $firstName = $this->getFirstName($fullName);
        $lastName = $this->getLastName($fullName, $firstName);
        echo($fullName . "\n");
//        echo($this->getFirstName($fullName) . "\n");
//        echo($lastName . "\n");
//        echo("================================================\n");
        $person = new Person([
            "fullname" => $fullName,
            "firstname" => $firstName,
            "lastname" => $lastName,
            "nationality1" => $row["nationality_code"],
        ]);
        $person->save();
        return $person;
    }
    
}
