<?php

namespace App\Http\Livewire;

use App\Movie;
use App\FilmFinancingPlan;

class TableEditMovieFinancingPlan extends TableEditBase
{

    public Movie $movie;

    protected function defaults()
    {
        return [
            'document_type' => '',
            'filename' => '',
            'comments' => '',
        ] + parent::defaults();
    }

    protected function rules()
    {
        return [
            'editing.media_id' => '',
            'editing.document_type' => 'required|string',
            'editing.filename' => 'required|string',
            'editing.comments' => 'required|string',
        ] + parent::rules();
    }

    protected function validationAttributes()
    {
        return [
            'editing.media_id' => 'media_id',
            'editing.document_type' => 'document type',
            'editing.filename' => 'filename',
            'editing.comments' => 'comments',
        ];
    }

    private function load()
    {
        $this->items = FilmFinancingPlan::where('media_id', $this->movie->media->id)->get()->toArray();
        $this->addUniqueKeys();
    }

    public function mount($movie_id = null)
    {
        if ($movie_id) {
            $this->movie = Movie::find($movie_id);
            $this->load();
        }
    }

    public function render()
    {
        return view('livewire.table-edit-movie-financing-plan');
    }

    protected function sendItems()
    {
        $this->emitUp('update-movie-film-financing-plans', $this->items);
    }
}
