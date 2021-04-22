<?php

namespace App\Models;

use App\Models\Movie;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Country extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function sales_distributors()
    {
        return $this->belongsToMany(Movie::class, 'sales_distributor_country');
    }

    public static function countries() {
        return Country::where('active', true)
            ->orderBy('name')
            ->get()
            ->toArray();
    }

    public static function countriesGrouped() {
        $countriesGrouped = Country::where('active', true)->get()
            ->sortBy([
                function ($a, $b) {
                    if ($a['group'] == 'eu' && $b['group'] == 'eu') return 0;
                    if ($a['group'] == 'eu' && $b['group'] == 'select') return -1;
                    if ($a['group'] == 'eu' && $b['group'] == 'other') return -1;
                    if ($a['group'] == 'select' && $b['group'] == 'eu') return 1;
                    if ($a['group'] == 'select' && $b['group'] == 'select') return 0;
                    if ($a['group'] == 'select' && $b['group'] == 'other') return -1;
                    if ($a['group'] == 'other' && $b['group'] == 'eu') return 1;
                    if ($a['group'] == 'other' && $b['group'] == 'select') return 1;
                    if ($a['group'] == 'other' && $b['group'] == 'other') return 0;
                },
                fn ($a, $b) => $a['position'] <=> $b['position'],
                fn ($a, $b) => $a['name'] <=> $b['name']
            ])
            ->groupBy('group')
            ->toArray();
        return $countriesGrouped;
    }

    public static function countriesGroupedChoices() {
        $c = Country::where('active', true)
            ->get()
            ->sortBy([
                function ($a, $b) {
                    if ($a['group'] == 'eu' && $b['group'] == 'eu') return 0;
                    if ($a['group'] == 'eu' && $b['group'] == 'select') return -1;
                    if ($a['group'] == 'eu' && $b['group'] == 'other') return -1;
                    if ($a['group'] == 'select' && $b['group'] == 'eu') return 1;
                    if ($a['group'] == 'select' && $b['group'] == 'select') return 0;
                    if ($a['group'] == 'select' && $b['group'] == 'other') return -1;
                    if ($a['group'] == 'other' && $b['group'] == 'eu') return 1;
                    if ($a['group'] == 'other' && $b['group'] == 'select') return 1;
                    if ($a['group'] == 'other' && $b['group'] == 'other') return 0;
                },
                fn ($a, $b) => $a['position'] <=> $b['position'],
                fn ($a, $b) => $a['name'] <=> $b['name']
            ])
            ->map(fn ($country) => [
                'group' => $country->group,
                'value' => $country->id,
                'label' => $country->name,
            ])
            ->groupBy('group')
            ->toArray();
        $i = 0;
        foreach ($c as $group => $choices) {
            $i++;
            $countriesGroupedChoices[] = [
                'label' => '---',
                'id' => $i,
                'choices' => $choices,
            ];
        }
        return $countriesGroupedChoices;
    }

    public static function countriesById() {
        return Country::where('active', true)
            ->orderBy('name')
            ->get()
            ->keyBy('id')
            ->toArray();
    }

    public static function countriesByCode() {
        return Country::where('active', true)
            ->orderBy('name')
            ->get()
            ->keyBy('code')
            ->toArray();
    }

    public static function countriesValueLabel() {
        return Country::where('active', true)
            ->get()
            ->map(fn ($country) => [
                'value' => $country->id,
                'label' => $country->name,
            ])
            ->toArray();    
    }
}
