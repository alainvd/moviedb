<?php

namespace App\Models;

use App\Models\Action;
use App\Models\Fiche;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dossier extends Model
{
    use HasFactory;

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
    ];

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

    public function movie()
    {
        return $this->belongsToMany(\App\Models\Movie::class);
    }

    public function checklists()
    {
        return $this->hasMany(\App\Models\Checklist::class);
    }

    public function fiches()
    {
        return $this->belongsToMany(Fiche::class)
            ->withPivot('activity_id');
    }
}
