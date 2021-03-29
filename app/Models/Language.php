<?php

namespace App\Models;

use App\Models\Movie;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasFactory;

    protected $appends = [
        'label',
        'chipLabel',
    ];
    protected $fillable = [
        'code',
        'name',
        'position',
    ];

    public function movies()
    {
        return $this->belongsToMany(Movie::class, 'movie_language');
    }

    public function getLabelAttribute(): string
    {
        return ucfirst($this->name) . " " . "(" . strtoupper($this->code) . ")";
    }

    public function getChipLabelAttribute(): string
    {
        return strtoupper($this->code);
    }
}
