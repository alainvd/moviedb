<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Dossier;
use App\Models\Action;
use App\Models\Call;
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
     * @return array()
     */
    public function columns()
    {
        return [
            Column::name('project_ref_id')
                ->label('ID')
                ->filterable()
                ->linkTo('dossiers', 6),
            Column::name('action.name')
                ->label('ACTION')
                ->filterable($this->actions), //todo link action filter values to DB
            NumberColumn::name('year')
                ->label('YEAR')
                ->filterable($this->years),
            
            Column::name('company')
                ->label('Company')
                ->filterable()
                ->searchable(),
            Column::name('status.name')
                 ->label('Status')
                 ->filterable($this->status),
            Column::name('updated_at')
                ->label('LAST UPDATE')
                ->defaultSort('desc')


        ];
    }

    public function getActionsProperty()
    {
        $sortedActions = ACTION::pluck('name')->sort()->unique()->values()->all();
        return $sortedActions;
    }

    public function getYearsProperty()
    {
        $sortedYears = CALL::pluck('year')->sortdesc()->unique()->values()->all();
        return $sortedYears;
    }

    public function getStatusProperty()
    {
        $sortedStatus = Status::pluck('name')->sortdesc()->values()->all();
        return $sortedStatus;
    }

    


}
