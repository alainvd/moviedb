<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'grantable_id',
        'grantable_type',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
    ];

    const LANGUAGES = [
        "fr" => "French",
        "bu" => "Bulgarian",
        "en" => "English",
        "de" => "German",
        "it" => "Italian",
        "es" => "Spanish",
        "ar" => "Arab",
        "ba" => "Bambara",
        "ta" => "Tamashek",
        "dk" => "Danish"
    ];

    const COUNTRIES = [
        "BE"=>"Belgium",
        "FR"=>"France"
    ];

    static function YEARS()
    {
        $yrs = [];
        for ($year=2020; $year>1990; $year-- ){
            $yrs[]=$year;
        }
        return $yrs;
    }

    const GENRES = [
        "fiction" => "Fiction",
        "creative_documentary" => "Creative Documentary",
        "animation" => "Animation",
        "series" => "Series",
        "live_action_children_film" => "Live-action children film",
    ];

    public function grantable()
    {
        return $this->morphTo();
    }
}
