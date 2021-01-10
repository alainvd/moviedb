<?php

namespace App\Http\Livewire;

class TableEditMovieProducersDevPrevious extends TableEditMovieProducers
{

    public $budget_total = 0;

    static function rules()
    {
        return [
            'editing.media_id' => '',
            'editing.role' => ['required'],
            'editing.name' => 'required|string|max:255',
            'editing.city' => '',
            'editing.country_id' => 'required',
            'editing.share' => 'required|integer|min:1|max:100',
            'editing.budget' => 'required|integer',
        ] + TableEditBase::rules();
    }

    public function render()
    {
        return view('livewire.table-edit-movie-producers', ['fiche' => 'devPrev']);
    }

    public function mount($movie_id = null)
    {
        parent::mount($movie_id);
        $this->recalculateBudget();
    }

    protected function recalculateBudget()
    {
        $this->budget_total = 0;
        foreach ($this->items as $item) {
            $this->budget_total += $item['budget'];
        }
    }

    public function saveItem()
    {
        parent::saveItem();
        $this->recalculateBudget();
    }

    public function deleteItem() {
        parent::deleteItem();
        $this->recalculateBudget();
    }
}