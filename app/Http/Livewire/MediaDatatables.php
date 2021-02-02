<?php

namespace App\Http\Livewire;


use App\Models\Country;
use App\Models\Movie;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;


class MediaDatatables extends LivewireDatatable
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
                ->linkTo('movies'),
            Column::name('original_title')
                ->label('TITLE'),
            Column::name('year_of_copyright')
                ->label('Year of Copyright')
                ->filterable($this->copyrightYears),

//            Column::callback('id','getDirectorName')
//                ->label('DIRECTOR'),
//            Column::callback('id', 'grantableCountry')
//                ->label('COUNTRY')
//                ->filterable(['AT','BE','CZ','DA','DE','ES','EL','FI','FR','IE','IT','LU']),
//            Column::name('')
//                ->label('STATUS'),
//            Column::name('fiche.status.name')
//                ->label('STATUS'),
//            Column::callback('id', 'grantableLastModificationDate')
//                ->label('LAST UPDATE')
//                ->filterable(),
        ];
    }

    public function getCopyrightYearsProperty()
    {
        $sortedYears = Movie::pluck('year_of_copyright')->sort()->unique()->values()->all();
        return $sortedYears;
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
                ->whereColumn('titles.id', 'crews.title_id')
                ->limit(1);
        }, 'DIRECTOR')->first();

        if ($director) {
            return $director->full_name;
        }

        return '';
    }



    public function grantableLastModificationDate($id)
    {
        return  Media::find($id)->grantable->updated_at;
    }


}
