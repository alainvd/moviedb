<?php

namespace App\Http\Livewire;

use App\Genre;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class SelectComponent extends Component
{

    public $options;
    private $pom;

    public $listeners = ['addItem','removeItem'];

    public function addItem($key){
        Log::info("Add Item called");
        Log::info($key);
    }

    public function removeItem($key){
        Log::info("Remove Item called");
        Log::info($key);
    }

    public function mount(){
        $genres = Genre::all();
//        dd($genres);
//        $this->options = json_encode($genres->pluck('name','id'));
        $this->pom = [];
        $genres->each(function ($item){
            $this->pom[] = (object)[
                "value"=>$item->id,
                "label"=>$item->name
            ];
        });



//        { value: 'One', label: 'Label One' },
//        { value: 'Two', label: 'Label Two', disabled: true },
//        { value: 'Three', label: 'Label Three' },

        $this->options = json_encode($this->pom);
//        dd($this->options);
    }

    public function render()
    {
        return view('livewire.select-component');
    }
}
