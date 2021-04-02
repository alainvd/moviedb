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

    public static function languagesValueLabel() {
        return Language::where('active', true)
            ->orderBy('position')
            ->orderBy('name')
            ->get()
            ->map(fn ($lang) => [
                'value' => $lang->id,
                'label' => $lang->name,
            ])
            ->toArray();
    }

    public static function languagesCodeName() {
        return Language::where('active', true)
            ->orderBy('position')
            ->orderBy('name')
            ->get()
            ->map(fn ($lang) => [
                'code' => $lang->code,
                'name' => $lang->name,
            ])
            ->toArray();
    }
}
