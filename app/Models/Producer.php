<?php

namespace App\Models;

use App\Models\Movie;
use App\Models\Country;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Producer extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'movie_id',
        'role',
        'name',
        'city',
        'country',
        'language',
        'share',
        'budget',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }

    static function defaultsProducer()
    {
        return [
            'role' => '',
            'name' => '',
            'city' => '',
            'country' => '',
            'language' => '',
            'share' => null,
            'budget' => null,
        ];
    }
}
