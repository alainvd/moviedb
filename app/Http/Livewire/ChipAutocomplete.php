<?php

namespace App\Http\Livewire;

use App\Models\Language;
use Livewire\Component;

/**
 * @todo sync list with input
 * @todo reset scroll on search
 * @todo maintain filter when text in input
 *
 */
class ChipAutocomplete extends Component
{
    public $listeners = [
        'chipRemoved' => 'removeItem',
    ];

    public $search;
    public $selected;

    public function mount()
    {
        $this->selected = collect([]);
    }

    public function addItem($item)
    {
        $this->selected->push($item);
    }

    public function removeItem($item)
    {
        $this->selected = $this->selected
            ->reject(fn ($selected) => $item === $selected);
    }

    public function render()
    {
        $options = Language::where(function ($query) {
            $query->where('name', 'like', "%{$this->search}%")
                ->orWhere('code', 'like', "%{$this->search}%");
            })
            ->orderBy('code')
            ->get()
            ->each(fn ($lang) => $lang->chipLabel = strtoupper($lang->code))
            ->reject(fn ($lang) => $this->selected->contains($lang->label))
            ->toArray();

        return view('livewire.chip-autocomplete', compact('options'));
    }
}
