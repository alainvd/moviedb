<?php

namespace App\Models;

use App\Models\Movie;
use App\Models\Country;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SalesAgent extends Model
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
        'country',
        'contact_person',
        'email',
        'distribution_date',
    ];

    protected $dates = [
        'distribution_date',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'distribution_date' => 'date:d.m.Y'
    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }

    static function defaultsSalesAgent()
    {
        return [
            'name' => '',
            'role' => '',
            'country' => '',
            'contact_person' => '',
            'email' => '',
            'distribution_date' => null,
        ];
    }
}
