<?php

namespace App\Models;

use App\Models\Country;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesAgent extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'movie_id',
        'name',
        'country',
        'contact_person',
        'email',
        'distribution_date',
    ];

    protected $dates = [
        'distribution_date',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'distribution_date' => 'date:d.m.Y'
    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }
}
