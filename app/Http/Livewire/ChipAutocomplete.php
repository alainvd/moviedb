<?php

namespace App\Http\Livewire;

use App\Models\Language;
use Livewire\Component;

/**
 * @todo abstract this to be able to use it with any model
 */
class ChipAutocomplete extends Component
{
    public $listeners = [
        'chipRemoved' => 'removeItem',
    ];

    public $domId;
    public $label;
    public $search;
    public $selected;
    public $options;

    public function mount()
    {
        $this->selected = collect([]);
    }

    public function addItem($item)
    {
        $this->selected->push($item);

        $this->selected = $this->selected->unique()->values();
        $this->search = "";
    }

    public function removeItem($label)
    {
        $this->selected = $this->selected
           ->reject(fn ($selected) => $label === $selected)
           ->values();
    }

    public function render()
    {
        $this->options = $this->getData();

        return view('livewire.chip-autocomplete');
    }

    private function getData()
    {
        return Language::where(function ($query) {
            $query->where('name', 'like', "%{$this->search}%")
                ->orWhere('code', 'like', "%{$this->search}%");
        })
            ->orderBy('code')
            ->get()
            ->reject(fn($lang) => $this->selected->contains($lang->chipLabel ?? $lang->label))
            ->values();
    }
}
