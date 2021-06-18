<?php

namespace App\Models;

use App\Models\Fiche;
use App\Models\Dossier;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reinvested extends Model
{
    use HasFactory;

    protected $fillable = [
        'fiche_id',
        'type_subtype',
        'grant',
    ];

    public function fiche()
    {
        return $this->belongsTo(Fiche::class);
    }

    public function dossier()
    {
        return $this->belongsToMany(Dossier::class);
    }
}
