<?php

namespace App\Imports;

use App\Models\Crew;
use App\Models\Genre;
use App\Media;
use App\Models\Person;
use App\Models\Title;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class StaffImport implements ToCollection, WithHeadingRow, WithChunkReading
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
        foreach ($this->getActors($collection) as $row) {

            //Get Person
            $actor = $this->getPerson($row);

            //Get Media
            $media = $this->getMedia($row);

            //Get Title
            $title = $this->getTitle($row);

            //Create the crew entry
            $crew = new Crew([
                "points" => $row['actor_points_points'] ? $row['actor_points_points'] : null,
                "person_id" => $actor->id,
                "title_id" => $title->id,
                "media_id" => $media->id
            ]);
            $crew->save();

        }

    }

    private function getTitle($row)
    {

        return Title::firstWhere("name", "=", $row["film_role_name"]);
    }

    private function getMedia($row)
    {
        $filmID = $row["id_code_film"];
        $media = Media::firstWhere([
            "grantable_id" => $filmID,
            "grantable_type" => "App\Models\Movie"
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
     * @param Collection $collection
     * @return Collection
     */
    public function getActors(Collection $collection): Collection
    {
        $actors = $collection->filter(function ($row, $key) {
            return (strpos($row["film_role_name"], 'Actor') !== false);
        });
        return $actors;
    }

    /**
     * @param $actor
     */
    public function getPerson($actor): Person
    {
        $fullName = (Str::of(Str::title($actor["film_staff_name"]))->trim());
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
            "nationality1" => $actor["film_staff_nationality_1_code"],
            "country_of_residence" => $actor["film_staff_residence_country"],
        ]);
        $person->save();
        return $person;
    }

    public function chunkSize(): int
    {
        return 1000;
    }
}
