<?php

namespace App\Http\Livewire;
use App\Models\Language;
use Illuminate\Support\Arr;

class TableEditMovieProducersDevCurrent extends TableEditMovieProducersDevPrevious
{

    protected function rules()
    {
        return [
            'editing.role' => 'required|string',
            'editing.name' => 'required|string|max:255',
            'editing.city' => 'string',
            'editing.country' => 'required|string',
            'editing.language' => 'string',
            'editing.share' => '',
            'editing.budget' => '',
        ] + TableEditBase::rules();
    }

    public function tableEditRules($isEditor)  {
        $rules = $this->rules() + TableEditBase::rules();
        return parent::rulesCleanup($rules);
    }

    public function render()
    {
        return view('livewire.table-edit-movie-producers', ['fiche' => 'devCurrent']);
    }

}
