<?php

namespace App;



use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoGame extends Model
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

    //protected $table = "videogames";

    public function genre()
    {
        return $this->belongsTo('App\Genre');
    }

    public function audience()
    {
        return $this->belongsTo('App\Audience');
    }




}
