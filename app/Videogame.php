<?php

namespace App;

use App\Interfaces\Grantable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Videogame extends Model implements Grantable
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'vgdb',
    ];

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
        return "I'm a video game ... BIIP BIP BIIIIIP";
    }
}
