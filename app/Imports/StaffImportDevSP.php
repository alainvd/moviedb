<?php

namespace App\Imports;

use App\Crew;
use App\Genre;
use App\Media;
use App\Person;
use App\Title;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class StaffImportDevSP implements ToCollection, WithHeadingRow, WithChunkReading
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

            //Get Person
            $person = $this->getPerson($row);

            //Get Media
            $media = $this->getMedia($row);

            //Get Title
            $title = $this->getTitle($row);

            //Create the crew entry
            $crew = new Crew([
                "person_id" => $person->id,
                "title_id" => $title->id,
                "media_id" => $media->id
            ]);
            $crew->save();

        }

    }

    private function getTitle($row)
    {

        return Title::firstWhere("name", "=", $row["role_name"]);
    }

    private function getMedia($row)
    {
        $filmID = $row["id_code_film"];
        $media = Media::firstWhere([
            "grantable_id" => $filmID,
            "grantable_type" => "App\Movie"
        ]);
        return $media;
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
            "fullname" => $fullName,
            "firstname" => $firstName,
            "lastname" => $lastName,
            "nationality1" => $row["nationality_code"],
        ]);
        $person->save();
        return $person;
    }
}
