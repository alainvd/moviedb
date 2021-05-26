<?php

namespace App\Imports;

use App\Models\Language;
use App\Models\Movie;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MoviesLanguagesImport implements ToModel, WithHeadingRow
{
   
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        //Get Language
        $language = $this->getLanguage($row);

        //Get movie
        $movie = $this->getmovie($row);
        
        if($language&&$movie){
            $movie->languages()->attach(
                $movie->id,
                [
                    'movie_id'=>$movie->id,
                    'language_id'=>$language ? $language->id: null
                ],
            );
            $movie->save(); 
        }

    }

    private function getLanguage($row)
    {

        echo($row["shooting_language"]);
        return Language::firstWhere("name", "=", $row["shooting_language"]);
        
    }

    private function getMovie($row)
    {

        echo(" - ".$row["id_code_film"]);
        return Movie::firstWhere("legacy_id", "=", $row["id_code_film"]);

    }

}
