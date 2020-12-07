<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\SalesAgent;
use App\Models\Country;

class TableEditMovieSalesAgents extends TableEditBase
{

    public $media_id = null;

    public $countries = [];

    protected function defaults()
    {
        return [
            'country_id' => Country::first()->id,
        ] + parent::defaults();
    }

    protected function rules()
    {
        return [
            'editing.media_id' => '',
            'editing.name' => 'required|string|max:255',
            'editing.country_id' => 'required',
            'editing.contact_person' => 'required|string|max:255',
            'editing.email' => 'required|string|max:255',
        ] + parent::rules();
    }

    protected function validationAttributes()
    {
        return [
            'editing.media_id' => 'media_id',
            'editing.name' => 'name',
            'editing.country_id' => 'country',
            'editing.contact_person' => 'contact person',
            'editing.email' => 'email',
        ] + parent::validationAttributes();
    }

    private function load()
    {
        $this->items = SalesAgent::where('media_id', $this->media_id)->get()->toArray();
        $this->addUniqueKeys();
    }

    public function mount($media_id = null)
    {
        $this->countries = Country::all()->keyBy('id')->toArray();
        if ($media_id) {
            $this->media_id = $media_id;
            $this->load();
        }
    }

    public function render()
    {
        return view('livewire.table-edit-movie-sales-agents');
    }

    protected function sendItems()
    {
        $this->emitUp('update-movie-sales-agents', $this->items);
    }
}
