<?php

namespace App\Models;

use App\Models\Country;
use App\Models\Dossier;
use App\Models\Admission;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AdmissionsTable extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'dossier_id',
        'country_id',
        'year',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
    ];


    public function dossier()
    {
        return $this->belongsTo(Dossier::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function admissions()
    {
        return $this->hasMany(Admission::class);
    }
}
