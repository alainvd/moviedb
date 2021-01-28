<?php

namespace App\Models;

use App\Media;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Distributor extends Model
{
    use HasFactory;

    protected $casts = [
        'forecast_release_date' => 'date:d.m.Y',
    ];

    protected $dates = [
        'forecast_release_date',
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

    public function media()
    {
        return $this->belongsToMany(Media::class);
    }
}
