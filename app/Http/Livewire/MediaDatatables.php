<?php

namespace App\Http\Livewire;

use App\Media;
use App\Models\Country;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;


class MediaDatatables extends LivewireDatatable
{

    public $hideable = 'select';
    public $countries = Country::class;
    public $model = Media::class;


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
            Column::name('fiche.id')
                ->label('ID')
                ->linkTo('media'),
            Column::name('title')
                ->label('TITLE'),
            Column::callback('grantable_type', 'mediaType')
                ->label('TYPE')
                ->filterable()
                ->hide(),
            Column::callback(['id'], function ($id) {
                return  Media::find($id)->grantable->year_of_copyright;
            })
                ->label('COPYRIGHT')
                ->filterable(['2021','2020','2019','2018','2017','2016','2015','2014']),
            Column::callback('id','getDirectorName')
                ->label('DIRECTOR'),
            Column::callback('id', 'grantableCountry')
                ->label('COUNTRY')
                ->filterable(['AT','BE','CZ','DA','DE','ES','EL','FI','FR','IE','IT','LU']),
            Column::name('fiche.status.name')
                ->label('STATUS'),
            Column::callback('id', 'grantableLastModificationDate')
                ->label('LAST UPDATE')
                ->filterable(),
        ];
    }


    public function mediaType($text)
    {


        if ($text=='App\Models\Movie') {

            return 'Movie';
        }

        else return 'VideoGame';
    }

    public function getDirectorName($id)
    {
        $director = Media::find($id)->people()->where(function ($query) {
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

    public function grantableCountry($id)
    {
        if (Media::find($id)->grantable_type == 'App\Models\Movie')
        {
            return  Media::find($id)->grantable->film_country_of_origin;
        }
        else { return 'ZZ';}
    }

    public function grantableLastModificationDate($id)
    {
        return  Media::find($id)->grantable->updated_at;
    }


}
