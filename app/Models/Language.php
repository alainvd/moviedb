<?php

namespace App\Models;

use App\Models\Movie;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    public static function languagesGrouped() {
        $languagesGrouped = Cache::rememberForever('languagesGrouped', function () {
            return Language::where('active', true)
                ->orderBy('position', 'desc')
                ->orderBy('name')
                ->get()
                ->groupBy('position')
                ->toArray();
        });
        return $languagesGrouped;
    }

    public static function languagesGroupedChoices() {
        $languagesGroupedChoices = Cache::rememberForever('languagesGroupedChoices', function () {
            $l = Language::where('active', true)
                ->orderBy('position', 'desc')
                ->orderBy('name')
                ->get()
                ->map(fn ($lang) => [
                    'position' => $lang->position,
                    'value' => $lang->id,
                    'label' => $lang->name,
                ])
                ->groupBy('position')
                ->toArray();
            $i = 0;
            foreach ($l as $group => $choices) {
                $i++;
                $lGroupedChoices[] = [
                    'label' => '',
                    'id' => $i,
                    'choices' => $choices,
                ];
            }
            return $lGroupedChoices;
        });
        return $languagesGroupedChoices;
    }

    public static function languagesCodeName() {
        $languagesCodeName = Cache::rememberForever('languagesCodeName', function () {
            return Language::where('active', true)
                ->orderBy('position', 'desc')
                ->orderBy('name')
                ->get()
                ->map(fn ($lang) => [
                    'code' => $lang->code,
                    'name' => $lang->name,
                ])
                ->toArray();
        });
        return $languagesCodeName;
    }
}
