<?php

namespace App\Imports;

use App\Audience;
use App\Genre;
use App\Media;
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

                $media = Media::where(
                    [
                        "grantable_id" => $row["id_code_film"]
                    ]
                )->firstOrFail();

                //Get the Genre
                $genre = Genre::firstOrCreate(
                    [
                        "name"=> $row["media_film_detailsfilm_genre"]
                    ],[
                        "type"=> $media->grantable_type
                    ]
                );

                $media->update(['genre_id' => $genre->id]);

            }

        }
    }
}
