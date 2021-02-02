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

    public function mount($movie_id = null)
    {
        parent::mount($movie_id);
        // TODO: somewhat dublication with MovieFicheFormComposer
        $this->languages = Language::where('active', true)
            ->get()
            ->map(fn ($lang) => [
                'code' => $lang->code,
                'name' => $lang->name,
            ])
            ->toArray();
    }

    public function render()
    {
        return view('livewire.table-edit-movie-producers', ['fiche' => 'devCurrent']);
    }

}
