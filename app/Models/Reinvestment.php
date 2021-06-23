<?php

namespace App\Models;

use App\Models\Fiche;
use App\Models\Dossier;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reinvestment extends Model
{
    use HasFactory;

    protected $fillable = [
        'fiche_id',
        'type_subtype',
        'grant',
    ];

    const TYPES_SUBTYPES = [
        'OPT1' => 'Film Financing / co-production',
        'OPT2' => 'Film Financing / minimum guarantee',
        'OPT3' => 'Release costs',
    ];

    public function fiche()
    {
        return $this->belongsTo(Fiche::class);
    }

    public function dossiers()
    {
        return $this->belongsToMany(Dossier::class);
    }
}
