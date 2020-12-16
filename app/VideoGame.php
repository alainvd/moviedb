<?php

namespace App;


use App\Events\VideoGameCreated;
use App\Interfaces\Grantable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoGame extends Model implements Grantable
{
    use HasFactory;

     //Event to create a media when we create a video game
     protected $dispatchesEvents = [
        'created' => VideoGameCreated::class,
    ];

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

    //protected $table = "videogames";


    public function media()
    {
        return $this->morphOne(\App\Media::class, 'grantable');
    }

    public function whoami()
    {
        return "I'm a video game ... BIIP BIP BIIIIIP";
    }


}
