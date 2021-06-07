<?php

namespace App\Models;

use App\Models\Movie;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
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
        $countries = Cache::rememberForever('countries', function () {
            return Country::where('active', true)
                ->orderBy('name')
                ->get()
                ->toArray();
        });
        return $countries;
    }

    public static function countriesGrouped() {
        $countriesGrouped = Cache::rememberForever('countriesGrouped', function () {
            return Country::where('active', true)
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
            ->groupBy('group')
            ->toArray();
        });
        return $countriesGrouped;
    }

    public static function countriesGroupedChoices() {
        $countriesGroupedChoices = Cache::rememberForever('countriesGroupedChoices', function () {
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
                $cGroupedChoices[] = [
                    'label' => '---',
                    'id' => $i,
                    'choices' => $choices,
                ];
            }
            return $cGroupedChoices;
        });
        return $countriesGroupedChoices;
    }

    public static function countriesByCode() {
        $countriesByCode = Cache::rememberForever('countriesByCode', function () {
            return Country::where('active', true)
                ->orderBy('name')
                ->get()
                ->keyBy('code')
                ->toArray();
        });
        return $countriesByCode;
    }

    public static function countriesValueLabel() {
        $countriesValueLabel = Cache::rememberForever('countriesValueLabel', function () {
            return Country::where('active', true)
                ->get()
                ->map(fn ($country) => [
                    'value' => $country->id,
                    'label' => $country->name,
                ])
                ->toArray();
        });
        return $countriesValueLabel;
    }
}
