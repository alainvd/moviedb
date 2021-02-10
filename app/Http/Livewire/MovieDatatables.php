<?php

namespace App\Http\Livewire;


use App\Models\Country;
use App\Models\Movie;
use App\Models\Status;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;


class MovieDatatables extends LivewireDatatable
{

    public $hideable = 'select';
    public $countries = Country::class;
    public $model = Movie::class;


    /**
     * Write code on Method
     *
     * @return array()
     */
    public function columns()
    {

        return [
            //Column::name('id')
            //  ->label('MEDIA ID'),
            Column::name('id')
                ->label('ID')
                ->linkTo('browse/movies'),
            Column::name('original_title')
                ->label('TITLE'),
            Column::name('year_of_copyright')
                ->label('YEAR OF COPYRIGHT')
                ->filterable($this->copyrightYears),
            Column::callback('id','getDirectorName')
                ->label('DIRECTOR'),
            Column::name('film_country_of_origin')
                ->label('COUNTRY')
                ->filterable($this->countryoforigin),
            Column::name('fiche.status.name')
                ->label('STATUS')
                ->filterable($this->statusAll),
            Column::name('updated_at')
                ->label('LAST UPDATE'),
                   
        ];
    }

    public function getCopyrightYearsProperty()
    {
        $sortedYears = Movie::pluck('year_of_copyright')->sort()->unique()->values()->all();
        return $sortedYears;
    }

    public function getCountryOfOriginProperty()
    {
        $sortedCountries = Movie::pluck('film_country_of_origin')->sort()->unique()->values()->all();
        return $sortedCountries;
    }

    public function getStatusAllProperty()
    {
        $sortedStatuses = Status::pluck('name')->sort()->unique()->values()->all();
        return $sortedStatuses;
    }

    public function mediaType($text)
    {

            return 'Movie';

    }

    public function getDirectorName($id)
    {
        $director = Movie::find($id)->people()->where(function ($query) {
            $query->select('code')
                ->from('titles')
                ->whereColumn('titles.id', 'crews.title_id');
        }, 'DIRECTOR')->first();

        if ($director) {
            return $director->fullname;
        }

        return '';
    }


}
