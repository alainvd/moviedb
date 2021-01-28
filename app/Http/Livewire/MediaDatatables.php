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
            Column::name('id')
                ->label('MEDIA ID'),
            Column::name('fiche.id')
                ->label('FICHE ID'),
            Column::name('title')
                ->label('Title'),
            Column::callback('grantable_type', 'mediaType')
                ->label('Type')
                ->filterable(),
            //Column::name('grantable.year_of_copyright')
            //    ->label('YEAR OF COPYRIGHT'),
            Column::name('crew.person_id')
                ->label('DIRECTOR'),             
            Column::name('fiche.status.name')
                ->label('STATUS'),
           
        ];
    }

    public function mediaType($text)
    {
        if ($text=='App\Movie') {

            return 'Movie';
        }
        
        else return 'VideoGame';
    }

    
}