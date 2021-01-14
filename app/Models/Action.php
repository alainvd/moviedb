<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Action extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
    ];

    public function activities()
    {
        return $this->belongsToMany(Activity::class)
            ->withPivot('rules')
            ->using(ActionActivity::class);
    }
}
