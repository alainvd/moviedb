<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admission extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'admissions_table_id',
        'fiche_id',
        'local_title',
        'release_date',
        'running_weeks',
        'certified_admissions',
        'screens_first_week',
        'screens_widest_release_week',
        'box_office_receipts',
        'eligibility_european_criteria_film',
        'eligibility_year_copyright',
        'eligibility_release_date',
        'eligibility_european_criteria_distributor',
        'eligibility_legal_status',
        'eligibility_length',
        'eligibility_european_nonnational_film',
        'eligibility_other_criteria',
        'eligibility_global_status',
        'eligibility_justification',
        'comments',
    ];

    protected $dates = [
        'release_date',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'release_date' => 'date:d.m.Y',
        'box_office_receipts' => 'integer',
        'eligibility_european_criteria_film' => 'boolean',
        'eligibility_year_copyright' => 'boolean',
        'eligibility_release_date' => 'boolean',
        'eligibility_european_criteria_distributor' => 'boolean',
        'eligibility_legal_status' => 'boolean',
        'eligibility_length' => 'boolean',
        'eligibility_european_nonnational_film' => 'boolean',
        'eligibility_other_criteria' => 'boolean',
        'eligibility_global_status' => 'boolean',
    ];


    public function admissionsTable()
    {
        return $this->belongsTo(\App\Models\AdmissionsTable::class);
    }

    public function fiche()
    {
        return $this->belongsTo(\App\Models\Fiche::class);
    }
}
