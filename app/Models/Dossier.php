<?php

namespace App\Models;

use App\Models\Action;
use App\Models\Fiche;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Traits\LogsActivity;

class Dossier extends Model
{
    use HasFactory, LogsActivity;

    protected $attributes = [
        'status_id' => Status::DRAFT, // Defaults to DRAFT
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'project_ref_id',
        'action_id',
        'year',
        'status_id',
        'call_id',
        'contact_person',
        'company',
        'created_by',
        'updated_by',
    ];

    // protected static $logFillable = true;
    protected static $logAttributes = [
        'status_id',
        'company',
    ];
    protected static $logOnlyDirty = true;
    protected static $submitEmptyLogs = false;

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
    ];

    // @todo remove action_id as we already have the call on the dossier
    public function action()
    {
        return $this->belongsTo(Action::class);
    }

    public function call()
    {
        return $this->belongsTo(Call::class);
    }

    public function checklists()
    {
        return $this->hasMany(\App\Models\Checklist::class);
    }

    public function fiches()
    {
        return $this->belongsToMany(Fiche::class)
            ->withPivot('activity_id')
            ->using(DossierFiche::class)
            ->orderBy('activity_id');
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function scopeForUser($query, $id)
    {
        return $query->where('created_by', $id);
    }
}
