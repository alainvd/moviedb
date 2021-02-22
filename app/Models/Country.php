<?php

namespace App\Models;

use App\Models\Movie;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Country extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function sales_distributors()
    {
        return $this->belongsToMany(Movie::class, 'sales_distributor_country');
    }
}
