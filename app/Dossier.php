<?php

namespace App;

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
        'action',
        'year',
        'status_id',
        'call_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
    ];


    public function media()
    {
        return $this->belongsToMany(\App\Media::class);
    }

    public function checklists()
    {
        return $this->hasMany(\App\Checklist::class);
    }

    public function fiches()
    {
        return $this->hasMany(Fiche::class);
    }

}
