<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fiche extends Model
{
    use HasFactory;

    protected $fillable = [
        'media_id',
        'dossier_id',
        'status_id',
        'created_by',
        'updated_by',
    ];

    public function media()
    {
        return $this->belongsTo('App\Media');
    }

    public function dossier()
    {
        return $this->belongsTo(Dossier::class);
    }
}
