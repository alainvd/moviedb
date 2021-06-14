<?php

namespace App\Imports;

use App\Models\Movie;
use App\Models\Language;
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
        // Get Language
        $language = $this->getLanguage($row);

        // Get movie
        $movie = $this->getmovie($row);
        
        if($language&&$movie){
            $movie->languages()->attach(
                $movie->id,
                ['movie_id' => $movie->id,
                'language_id' => $language ? $language->id : null]
            );
            $movie->save();
        }
        // if (!$language && $row['shooting_language_code'] != '') {
        //     echo "Language or movie not found: " . $row['shooting_language'] . " " . $row['shooting_language_code'] . " " . $row['id_code_film'] . "\n";
        // }
    }

    private function getLanguage($row)
    {
        if ($row["shooting_language_code"] != '') {
            /*
            $okn = [
                // languages that get well mapped by name or code
                'english',
                'french',
                'german',
                'spanish',
                'italian',
                'polish',
                'dutch',
                'romanian',
                'hungarian',
                'finnish',
                'russian',
                'norwegian',
                'danish',
                'czech',
                'slovak',
                'arab',
                'arabic',
                'lingala',
                'swedish',
                'turkish',
                'estonian',
                'basque',
                'estonian',
                'ukrainian',
                'portuguese',
                'swahili',
                'bulgarian',
                'bosnian',
                'latvian',
                'javanese',
                'romany',
                'latin',
                'esperanto',
                'japanese',
                'persan',
                'albanian',
                'mongolian',
                'serbian',
                'yiddish',
                'hebrew',
                'chuang',
                'yoruba',
                'xhosa',
                'wolof',
                'welsh',
                'walloon',
                'volapük',
                'vietnamese',
                'uzbek',
                'urdu',
                'uighur',
                'twi',
                'turkmen',
                'tswana',
                'tsonga',
                'tonga (tonga islands)',
                'tigrinya',
                'thai',
                'telugu',
                'tatar',
                'tamil',
                'tajik',
                'tagalog',
                'zulu',
                'zhuang; chuang',
                'tahitian',
                'swati',
                'sundanese',
                'sotho, southern',
                'somali',
                'slovenian',
                'sindhi',
                'shona',
                'serbo-croatian',
                'scottish gaelic; gaelic',
                'sardinian',
                'sanskrit',
                'sango',
                'samoan',
                'raeto-romance',
                'quechua',
                'panjabi',
                'pali',
                'ossetian; ossetic',
                'oromo',
                'oriya',
                'nyanja; chichewa; chewa',
                'north ndebele',
                'nepali',
                'ndonga',
                'ndebele, south',
                'navajo; navaho',
                'nauru',
                'marshallese',
                'marathi',
                'maori',
                'manx',
                'maltese',
                'malayalam',
                'malay',
                'malagasy',
                'macedonian',
                'luxembourgish; letzeburgesch',
                'lithuanian',
                'lao',
                'kurdish',
                'kuanyama; kwanyama',
                'korean',
                'komi',
                'kirghiz',
                'kinyarwanda',
                'khmer',
                'kazakh',
                'kashmiri',
                'kannada',
                'kalaallisut',
                'irish',
                'inupiaq',
                'inuktitut',
                'interlingue',
                'indonesian',
                'ido',
                'idelandic',
                'hiri motu',
                'hindi',
                'herero',
                'hausa',
                'gujarati',
                'guarani',
                'greek (modern)',
                'gikuyu; kikuyu',
                'georgian',
                'gallegan',
                'frisian',
                'fijian',
                'faroese',
                'dzongkha',
                'croatian',
                '"crnogorski; montenegrin"',
                'corsican',
                'cornish',
                'chuvash',
                'chinese',
                'chechen',
                'chamorro',
                'catalan',
                'burmese',
                'breton',
                'bislama',
                'bihari',
                'bengali',
                'belarusian',
                'azerbaijani',
                'aymara',
                'avestan',
                'assamese',
                'armenian',
                'amharic',
                'afrikaans',
                'afar',
                'abkhazian',
                'icelandic',
                'portugese',
                'rundi',
                'montenegrin',
                // missing languages
                'bambara',
                'tamashek',
                'pashto',
                'creoles and pidgins',
                'occitan',
                'berber',
                'masai',
            ];
            */
            /*
            if (!in_array(strtolower(trim($row["shooting_language"])), $okn)) {
                echo "\n";
                echo $row["shooting_language"]."\n";
                echo $row["shooting_language_code"]."\n";
            }
            */
            $language_name = $row["shooting_language"];
            if ($language_name == 'Portugese') $language_name='Portuguese';
            if ($language_name == 'Bosniac') $language_name='Bosnian';
            if ($language_name == 'Lëtzebuergesch') $language_name='Luxembourgish';
            if ($language_name == 'Montenegrin') $language_name='Crnogorski';
            if ($lang = Language::firstWhere("name", "=", $language_name)) {
                /*
                if (!in_array(strtolower(trim($row["shooting_language"])), $okn)) {
                    echo "Language detected by name: " . $lang->code . ": ". $lang->name . "\n";
                }
                */
                return $lang;
            }
            elseif ($lang = Language::firstWhere("code", "=", strtolower(trim($row["shooting_language_code"])))) {
                /*
                if (!in_array(strtolower(trim($row["shooting_language"])), $okn)) {
                    echo "Language detected by code: " . $lang->code . ": ". $lang->name . "\n";
                }
                */
                return $lang;
            }
        }
        return NULL;
    }

    private function getMovie($row)
    {
        // echo(" - ".$row["id_code_film"].'  ');
        return Movie::firstWhere("legacy_id", "=", $row["id_code_film"]);
    }

}
