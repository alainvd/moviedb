<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Crew extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'points',
        'person_id',
        'title_id',
        'movie_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
    ];


    public function title()
    {
        return $this->belongsTo(\App\Models\Title::class);
    }

    public function person()
    {
        return $this->hasOne(\App\Models\Person::class, 'id', 'person_id');
    }

    public function movie()
    {
        return $this->belongsTo(\App\Models\Movie::class);
    }
}
