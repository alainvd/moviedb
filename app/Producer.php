<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producer extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'media_id',
        'role',
        'name',
        'city',
        'country_id',
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
        return $this->belongsTo(\App\Models\Country::class);
    }

    public function media()
    {
        return $this->belongsTo(\App\Media::class);
    }

    const ROLES = [
        'producer' => 'Producer',
        'coproducer' => 'Co-producer',
    ];
}
