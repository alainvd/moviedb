<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function newPerson()
    {

    }

    public function media()
    {
        return $this->belongsTo(\App\Media::class, 'media_id', 'id');
    }

}
