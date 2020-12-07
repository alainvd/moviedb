<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Producer;
use App\Models\Country;
use Illuminate\Support\Str;

class TableEditMovieProducers extends TableEditBase
{

    public $media_id = null;

    public $countries = [];

    public $producer_roles = [];

    protected function defaults()
    {
        return [
            'role' => 'producer',
            'country_id' => Country::first()->id,
        ] + parent::defaults();
    }

    protected function rules()
    {
        return [
            'editing.media_id' => '',
            'editing.role' => 'required',
            'editing.name' => 'required|string|max:255',
            'editing.city' => 'required|string|max:255',
            'editing.country_id' => 'required',
            'editing.share' => 'required|integer',
            'editing.budget' => 'required|integer',
        ] + parent::rules();
    }

    protected function validationAttributes()
    {
        return [
            'editing.media_id' => 'media_id',
            'editing.role' => 'role',
            'editing.name' => 'name',
            'editing.city' => 'city',
            'editing.country_id' => 'country',
            'editing.share' => 'share',
            'editing.budget' => 'budget',
        ] + parent::validationAttributes();
    }

    private function load()
    {
        $this->items = Producer::where('media_id', $this->media_id)->get()->toArray();
        $this->addUniqueKeys();
    }

    public function mount($media_id = null)
    {
        $this->countries = Country::all()->toArray();
        $this->producer_roles = Producer::ROLES;
        if ($media_id) {
            $this->media_id = $media_id;
            $this->load();
        }
    }

    public function render()
    {
        return view('livewire.table-edit-movie-producers');
    }

    protected function sendItems()
    {
        $this->emitUp('update-movie-producers', $this->items);
    }
}
