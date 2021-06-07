<?php

namespace App\Imports;

use App\Models\Crew;
use App\Models\Movie;
use App\Models\Title;
use App\Models\Person;
use Illuminate\Support\Str;
use App\Imports\RolesImport;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class StaffImportDist implements ToCollection, WithHeadingRow, WithChunkReading
{
    
    public function chunkSize(): int
	{
		return 5000;
	}
    
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        foreach ($collection as $row) {

            // Get Person
            $actor = $this->getPerson($row);

            // Get Movie
            $movie = $this->getMovie($row);

            // Get Title
            $title = $this->getTitle($row);

            // Create the crew entry
            if ($movie){
                $crew = new Crew([
                    "points" => $row['film_staff_score'] ? $row['film_staff_score'] : null,
                    "person_id" => $actor->id,
                    "title_id" => $title->id,
                    "movie_id" => $movie->id
                ]);
                $crew->save();
            }

        }
        echo("DIST Staff import 5000 ok\n");
        return;
    }

    private function getTitle($row)
    {
        $title_code = RolesImport::rolesNameMap($row["film_role_name"]);
        return Title::firstWhere("code", "=", $title_code);
    }

    private function getMovie($row)
    {
        $filmID = $row["id_code_film"];
        $movie = Movie::where("legacy_id", "=", $filmID)->first();
        return $movie;
    }

    public function getFirstName($fullname)
    {
        if ($parts = explode(" ", $fullname)) {
            return explode(" ", $fullname)[0];
        }
        else {
            return "-";
        }
    }

    public function getLastName($fullname, $firstname)
    {
        if ($firstname == "N/A") {
            return "";
        }
        elseif (strlen($fullname) > strlen($firstname)) {
            return substr($fullname, strlen($firstname) + 1);
        }
        else {
            return '-';
        }
    }

    /*/**
     * @param Collection $collection
     * @return Collection
     */
    /* public function getActors(Collection $collection): Collection
    {
        $actors = $collection->filter(function ($row, $key) {
            return (strpos($row["film_role_name"], 'Actor') !== false);
        });
        return $actors;
    } */

    /**
     * @param $actor
     */
    public function getPerson($row): Person
    {
        $fullName = (Str::of(Str::title($row["film_staff_name"]))->trim());
        $firstName = $this->getFirstName($fullName);
        $lastName = $this->getLastName($fullName, $firstName);
        // echo($fullName . "\n");
        // echo($this->getFirstName($fullName) . "\n");
        // echo($lastName . "\n");
        // echo("================================================\n");
        $person = new Person([
            "firstname" => $firstName,
            "lastname" => $lastName,
            "gender" => 'NA',
            "nationality1" => MoviesImportDist::getCountryCode($row["film_staff_nationality_1_code"]),
            "nationality2" => $row["film_staff_nationality_2_code"] ?? '',
            "country_of_residence" => MoviesImportDist::getCountryCode($row["film_staff_residence_country_code"]),
        ]);
        $person->save();
        return $person;
    }
}
