<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'movie_id',
        'type',
        'name',
        'country',
        'points',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
    ];

    const LOCATION_TYPES = [
        'SHOOT' => 'Shooting Location',
        'POST' => 'Post Production Location',
        'STUDIO' => 'Studio Location',
        'LAB' => 'Laboratory / Post Production'
    ];

    public function movie()
    {
        return $this->belongsTo(\App\Movie::class);
    }

    static function defaultsLocation()
    {
        return [
            'type' => '',
            'name' => '',
            'country' => '',
            'points' => null,
        ];
    }
}
