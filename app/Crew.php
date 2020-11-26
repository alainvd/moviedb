<?php

namespace App;

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
        'media_id',
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
        return $this->belongsTo(\App\Title::class);
    }

    public function person()
    {
        return $this->hasOne(\App\Person::class, 'id', 'person_id');
    }

    public function media()
    {
        return $this->belongsTo(\App\Media::class);
    }
}
