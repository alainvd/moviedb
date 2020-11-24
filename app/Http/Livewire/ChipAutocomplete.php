<?php

namespace App\Http\Livewire;

use App\Models\Language;
use Illuminate\Support\Facades\Log;
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
    public $options;

    public function mount()
    {
        $this->selected = collect([]);

    }

    public function addItem($item)
    {
        Log::info("addItem Called". $item);
        $this->selected->push($item);

            $this->selected = $this->selected->unique()->values();
    }

    public function removeItem($label)
    {

        $filtered = $this->selected->filter(function ($value, $key) use ($label) {
            Log::info($value . " - " . $label);
            return $value !== $label;
        })->values()->all();

        Log::info($filtered );


        $this->selected = collect($filtered);

//        $this->selected = $this->selected
//            ->reject(fn ($selected) => $item === $selected);
    }

    public function render()
    {

        $this->options = $this->getData();

        return view('livewire.chip-autocomplete');
    }

    private function getData(){
        return Language::where(function ($query) {
            $query->where('name', 'like', "%{$this->search}%")
                ->orWhere('code', 'like', "%{$this->search}%");
        })
            ->orderBy('code')
            ->get()
            ->each(fn ($lang) => $lang->chipLabel = strtoupper($lang->code))
            ->reject(fn ($lang) => $this->selected->contains($lang->label))
            ->values();
    }
}
