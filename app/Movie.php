<?php

namespace App;

use App\Interfaces\Grantable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model implements Grantable
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
    ];


    public function media()
    {
        return $this->morphOne(\App\Media::class, 'grantable');
    }

    public function whoami(){
        return "I'm a movie ... bring some popcorn";
    }

//    public function audience(){
//        return $this->media()->audience();
//    }
}
