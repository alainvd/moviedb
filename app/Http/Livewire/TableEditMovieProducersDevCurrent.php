<?php

namespace App\Http\Livewire;
use App\Models\Language;
use Illuminate\Support\Arr;

class TableEditMovieProducersDevCurrent extends TableEditMovieProducersDevPrevious
{

    static function rules()
    {
        return [
            'editing.media_id' => '',
            'editing.role' => ['required'],
            'editing.name' => 'required|string|max:255',
            'editing.city' => '',
            'editing.country_id' => 'required',
            'editing.language_id' => '',
            'editing.share' => '',
            'editing.budget' => '',
        ] + TableEditBase::rules();
    }

    public function mount($movie_id = null)
    {
        parent::mount($movie_id);
        // TODO: dublication with MovieFicheFormComposer
        $this->languages = Language::where('active', true)
            ->get()
            ->map(fn ($lang) => [
                'value' => $lang->id,
                'label' => $lang->name,
            ])
            ->toArray();
    }

    public function render()
    {
        return view('livewire.table-edit-movie-producers', ['fiche' => 'devCurrent']);
    }

}