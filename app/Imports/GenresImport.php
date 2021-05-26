<?php

namespace App\Imports;

use App\Models\Audience;
use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class GenresImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        foreach ($collection as $row) {

            if ($row["media_film_detailsfilm_genre"]) {

                $movie = Movie::where(["legacy_id" => $row["id_code_film"]])->firstOrFail();

                //Get the Genre
                $genre = Genre::firstOrCreate(
                    ["name"=> $row["media_film_detailsfilm_genre"]],
                    ["type"=> "Movie"]
                );

                $movie->update(['genre_id' => $genre->id]);

            }

        }
    }
}
