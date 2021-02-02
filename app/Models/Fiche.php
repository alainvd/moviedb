<?php

namespace App\Models;

use App\Models\Dossier;
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
        'activity_id'
    ];

    public function media()
    {
        return $this->belongsTo('App\Media');
    }

    public function dossier()
    {
        return $this->belongsTo(Dossier::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function scopeForActivity($query, $activityId)
    {
        return $query->where('activity_id', $activityId);
    }
}
