<?php

namespace App\Imports;

use App\Models\Crew;
use App\Models\Movie;
use App\Models\Person;
use App\Models\Title;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class StaffImportDevSP implements ToCollection, WithHeadingRow, WithChunkReading
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

            // Get Person
            $person = $this->getPerson($row);

            // Get Movie
            $movie = $this->getMovie($row);

            // Get Title
            $title = $this->getTitle($row);

            // Create the crew entry
            if ($movie){
                $crew = new Crew([
                    "person_id" => $person->id,
                    "title_id" => $title->id,
                    "movie_id" => $movie->id
                ]);
                $crew->save();
            }

        }
    }

    private function getTitle($row)
    {
        return Title::firstWhere("code", "=", $row["role"]);
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
    public function getPerson($row): Person
    {
        $fullName = (Str::of(Str::title($row["name"]))->trim());
        $firstName = $this->getFirstName($fullName);
        $lastName = $this->getLastName($fullName, $firstName);
        echo($fullName . "\n");
//        echo($this->getFirstName($fullName) . "\n");
//        echo($lastName . "\n");
//        echo("================================================\n");
        $person = new Person([
            "firstname" => $firstName,
            "lastname" => $lastName,
            "nationality1" => $row["nationality"],
            "gender" => $this->getGender($row["gender"]),
        ]);
        $person->save();
        return $person;
    }

    public function getGender($gender)
    {
        if ($gender == 'X') return 'NA';
        if ($gender == 'Undefined') return 'NA';
        if ($gender == 'UNDEFINED') return 'NA';
        if ($gender == 'Female') return 'FEMALE';
        if ($gender == 'Male') return 'MALE';
        return $gender;
    }
}
