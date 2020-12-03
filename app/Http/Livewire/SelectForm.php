<?php

namespace App\Http\Livewire;

use App\Genre;
use App\Models\Language;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class SelectForm extends Component
{

    public $genres;
    public $languages;

    public $selected = [];

//    public $selectvalues;

    public $listeners = ['addItem','removeItem'];

    public function addItem($item)
    {
        Log::info("Item added in a select component and caught in form");
        $name = $item[0];
        $label = $item[1]['label'];
        $value = $item[1]['value'];

        $this->selected[$name][] = $value;
//        Log::info($name);
//        Log::info($value);
//        Log::info($label);
//        Log::info($this->selected);
    }
    public function removeItem($item)
    {
        Log::info("Item remove in a select component and caught in form");
        $name = $item[0];
        $label = $item[1]['label'];
        $value = $item[1]['value'];

        // Search
        $pos = array_search($value, $this->selected[$name]);

        // Remove from array
        unset($this->selected[$name][$pos]);

    }


    private function convert($collection)
    {
        $this->temp = [];
        $collection->each(function ($item) {
            $this->temp[] = (object)[
                "value" => $item->id,
                "label" => $item->name
            ];
        });
        return json_encode($this->temp);
    }

    public function save()
    {
//        Log::info("Persisting the data in the database for the form with the following values");
//        Log::info("Selected Genres");
//        Log::info("Selected Languages");
    }

    public function render()
    {
        $this->genres = $this->convert(Genre::all());
        $this->languages = $this->convert(Language::all());
        return view('livewire.select-form');
    }
}
