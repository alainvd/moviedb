<?php

namespace App\Models;

use App\Models\Fiche;
use App\Models\Action;
use App\Models\Reinvestment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
        'status_id',
        'year',
        'call_id',
        'contact_person',
        'pic',
        'company',
        'country',
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

    public function getPublicStatusAttribute()
    {
        $status = $this->status->name;
        if (Auth::user()->hasRole('applicant')) {
            return in_array($status, ['Draft', 'Submitted']) ? $status : 'Submitted';
        }

        return $status;
    }

    public function scopeForUser($query, $id)
    {
        return $query->where('created_by', $id);
    }

    public function reinvestments()
    {
        return $this->belongsToMany(Reinvestment::class);
    }
}
