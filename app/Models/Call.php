<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Call extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'action_id',
        'year',
        'published_at',
        'status',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'published_at',
    ];

    public function getClosedAttribute()
    {
        if ($this->attributes['status']) {
            return $this->attributes['status'] === 'closed';
        }
        if ($this->deadline2) {
            return Carbon::now()->greaterThanOrEqualTo($this->deadline2);
        }
        if ($this->deadline1) {
            return Carbon::now()->greaterThanOrEqualTo($this->deadline1);
        }
        // TODO: change to true when testing is done
        return false;
    }

    public function getStatusAttribute()
    {
        return $this->closed ? 'closed' : 'open';
    }

    public function dossiers()
    {
        return $this->hasMany(\App\Models\Dossier::class);
    }

    public function action(){
        return $this->belongsTo(\App\Models\Action::class);
    }

    public function scopeClosed($query)
    {
        return $query->where('status', 'closed')
            ->orWhere(function ($query) {
                $query->whereDate('deadline1', '<=', Carbon::now())
                    ->orWhereDate('deadline2', '<=', Carbon::now());
            });
    }

    public function scopeOpen($query)
    {
        return $query->where('status', 'open')
            ->orWhere(function ($query) {
                $query->whereDate('deadline1', '>', Carbon::now())
                    ->orWhereDate('deadline2', '>', Carbon::now());
            });
    }
}
