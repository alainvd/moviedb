<?php

namespace App\Http\Livewire;

class TableEditMovieProducersDevPrevious extends TableEditMovieProducers
{

    protected function rules()
    {
        return [
            'editing.role' => 'required|string',
            'editing.name' => 'required|string|max:255',
            'editing.city' => 'string',
            'editing.country' => 'required|string',
            'editing.language' => 'string',
            'editing.share' => 'required|integer|min:1|max:100',
            'editing.budget' => 'required|integer',
        ] + TableEditBase::rules();
    }

    public function tableEditRules($isEditor)  {
        $rules = $this->rules() + TableEditBase::rules();
        return parent::rulesCleanup($rules);
    }
    
    public function render()
    {
        return view('livewire.table-edit-movie-producers', ['fiche' => 'devPrev', 'rules' => $this->rules()]);
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
