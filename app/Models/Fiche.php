<?php

namespace App\Models;

use App\Models\Dossier;
use App\Models\Movie;
use App\Models\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fiche extends Model
{
    use HasFactory;

    protected $fillable = [
        'movie_id',
        'dossier_id',
        'activity_id',
        'status_id',
        'created_by',
        'updated_by',
        'comments',
        'type',
    ];

    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }

    public function dossiers()
    {
        return $this->belongsToMany(Dossier::class)
            ->withPivot('activity_id');
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function scopeForActivity($query, $activityId)
    {
        // return $query->where(function ($query) {
        //     $query->select('activity_id')
        //         ->from('dossier_fiche')
        //         ->whereColumn('fiche_id', 'fiches.id')
        //         ->get();
        // }, $activityId);
        return $query->where('dossier_fiche.activity_id', $activityId);
    }
}
