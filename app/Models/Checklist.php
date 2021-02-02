<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checklist extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'position',
        'status',
        'dossier_id',
        'step_id',
        'status_by',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
    ];


    public function step()
    {
        return $this->belongsTo(\App\Models\Step::class);
    }

    public function dossier()
    {
        return $this->belongsTo(\App\Models\Dossier::class);
    }

    public function movie()
    {
        return $this->belongsTo(\App\Models\Movie::class);
    }
}
