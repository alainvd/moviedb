<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Crew;
use App\Media;
use App\Movie;
use App\Person;
use App\VideoGame;
use App\Fiche;
use App\Models\Action;
use App\Models\Status;
use Illuminate\Support\Str;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Illuminate\Support\Facades\Log;



class MediaDatatables extends LivewireDatatable
{


    public $model = Media::class;



    /**
     * Write code on Method
     *
     * @return response()
     */
    public function columns()
    {
        return [
            //Column::name('id')
            //  ->label('MEDIA ID'),
            Column::name('fiche.id')
                ->label('FICHE ID'),
            Column::name('title')
                ->label('TITLE'),
            Column::callback('grantable_type', 'mediaType')
                ->label('TYPE')
                ->filterable(),
            Column::callback(['id'], function ($id) {
                return  Media::find($id)->grantable->year_of_copyright;
            })
                ->label('COPYRIGHT')
                ->filterable(),
            Column::name('crew.person_id')
                ->label('DIRECTOR'),
            Column::callback('id', 'grantableCountry')
                ->label('COUNTRY')
                ->filterable(),
            Column::name('fiche.status.name')
                ->label('STATUS'),
            Column::callback('id', 'grantableLastModificationDate')
                ->label('LAST UPDATE')
                ->filterable(),
        ];
    }

    public function mediaType($text)
    {


        if ($text=='App\Movie') {

            return 'Movie';
        }

        else return 'VideoGame';
    }

    public function grantableCountry($id)
    {
        if (Media::find($id)->grantable_type == 'App\Movie')
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
