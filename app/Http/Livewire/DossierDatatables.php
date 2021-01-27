<?php
  
namespace App\Http\Livewire;
   
use Livewire\Component;
use App\Dossier;
use App\Models\Action;
use App\Models\Status;
use Illuminate\Support\Str;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;


  
class DossierDatatables extends LivewireDatatable
{
    
    
    public $model = Dossier::class;

    
    
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function columns()
    {
        return [
            Column::name('action.name')
                ->label('ACTION')
                ->filterable(['DEVSLATE','DEVSLATEEUMINI','DISTSEL','EUCODEV','TV']), //todo link action filter values to DB
            NumberColumn::name('year')
                ->label('YEAR')
                ->filterable(['2021','2020','2019','2018','2017']),
            Column::name('project_ref_id')
                ->label('ID')
                ->linkTo('project', 6),
            Column::name('company')
                ->label('Company')
                ->filterable()
                ->searchable(),
            Column::name('status_id')
                ->label('Status'),
            Column::name('updated_at')
                ->label('LAST UPDATE')
                ->defaultSort('desc')
  
           
        ];
    }

    
}