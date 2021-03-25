<?php

namespace App\Models;

use App\Models\Dossier;
use App\Models\Movie;
use App\Models\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Traits\LogsActivity;

class Fiche extends Model
{
    use HasFactory, LogsActivity;

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

    protected static $logFillable = true;

    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }

    public function dossiers()
    {
        return $this->belongsToMany(Dossier::class)
            ->withPivot('activity_id')
            ->using(DossierFiche::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function scopeForActivity($query, $activityId)
    {
        return $query->where('dossier_fiche.activity_id', $activityId);
    }
}
