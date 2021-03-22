<?php

namespace App\Models;

use App\Models\Movie;
use App\Models\Country;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SalesDistributor extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'movie_id',
        'name',
        'role',
        'release_date',
    ];

    protected $dates = [
        'release_date',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'release_date' => 'date:d.m.Y'
    ];


    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }

    public function countries()
    {
        return $this->belongsToMany(Country::class, 'sales_distributor_country');
    }

    static function defaultsSalesDistributor()
    {
        return [
            'name' => '',
            'role' => '',
            'countries' => [],
            'release_date' => null,
        ];
    }
}
