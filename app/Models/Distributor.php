<?php

namespace App\Models;

use App\Models\Movie;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Distributor extends Model
{
    use HasFactory;

    protected $dates = [
        'forecast_release_date'
    ];

    protected $fillable = [
        'country_id',
        'name',
        'forecast_release_date',
        'forecast_grant',
        'role',
    ];

    protected $with = [
        'country',
    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function movie()
    {
        return $this->belongsToMany(Movie::class);
    }

    public function getForecastReleaseDateAttribute($value)
    {
        return $value ? date('d.m.Y', strtotime($value)) : null;
    }
}
