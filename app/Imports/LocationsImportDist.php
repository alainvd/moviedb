<?php

namespace App\Imports;

use App\Models\Movie;
use App\Models\Country;
use App\Models\Location;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class LocationsImportDist implements ToCollection, WithHeadingRow, WithChunkReading
{

    public function chunkSize(): int
	{
		return 1000;
	}

    public function locationsNameMap($location_name)
    {
        switch(strtolower($location_name)) {
            case 'shooting location':
            case 'shooting location 2':
            case 'shooting location 3':
            case 'shooting location 4':
            case 'shooting location 5':
            case 'shooting location 6':
            case 'shooting location 7':
            case 'shooting location 8':
            case 'shooting location 9':
                return 'SHOOT';

            case 'post production location':
            case 'post production location 2':
            case 'post production location 3':
            case 'post production location 4':
            case 'post production location 5':
            case 'post production location 6':
            case 'post production location 7':
            case 'post production location 8':
            case 'post production location 9':
                return 'POST';

            case 'studio location':
            case 'studio location 2':
            case 'studio location 3':
            case 'studio location 4':
            case 'studio location 5':
            case 'studio location 6':
            case 'studio location 7':
            case 'studio location 8':
            case 'studio location 9':
                return 'STUDIO';
        }
        echo "Error: no match for location name '".$location_name."'";
    }

    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        foreach ($collection as $row) {

            // Get Movie
            $movie = $this->getMovie($row);

            // Get country from location name
            $country = Country::firstWhere("name", "=", $row['film_staff_name']);

            // Create the location
            if ($movie) {
                $location = new Location([
                    "movie_id" => $movie->id,
                    "type" => $this->locationsNameMap($row['film_role_name']),
                    "name" => $row['film_staff_name'],
                    "country" => $country ? $country->code : null,
                    // "points" => $row['actor_points_points'] ? $row['actor_points_points'] : null,
                    "points" => null,
                ]);
                $location->save();
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
