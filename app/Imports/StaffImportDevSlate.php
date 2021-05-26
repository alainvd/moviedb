<?php

namespace App\Imports;

use App\Models\Crew;
use App\Models\Genre;
use App\Media;
use App\Models\Movie;
use App\Models\Person;
use App\Models\Title;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class StaffImportDevSlate implements ToCollection, WithHeadingRow, WithChunkReading
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

            //Get Person
            $person = $this->getPerson($row);

            //Get Media
            $movie = $this->getMovie($row);

            //Get Title
            $title = $this->getTitle($row);

            //Create the crew entry
            $crew = new Crew([
                "person_id" => $person->id,
                "title_id" => $title->id,
                "movie_id" => $movie->id
            ]);
            $crew->save();

        }

    }

    private function getTitle($row)
    {
        return Title::firstWhere("name", "=", $row["role"]);
    }

    private function getMovie($row)
    {
        $filmID = $row["id_code_film"];
        echo($filmID);
        $movie = Movie::where("legacy_id","=",$filmID)->first();
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
            "nationality1" => $row["nationality_code"],
            "gender" => $row["gender"],
        ]);
        $person->save();
        return $person;
    }
}
