<?php

namespace App\Http\Livewire;

use App\Movie;
use App\Producer;
use App\Models\Country;
use Illuminate\Validation\Rule;

class TableEditMovieProducers extends TableEditBase
{

    public Movie $movie;

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
            'editing.role' => [
                'required',
                Rule::in(array_keys($this->producer_roles))
            ],
            'editing.name' => 'required|string|max:255',
            'editing.city' => 'required|string|max:255',
            'editing.country_id' => 'required',
            'editing.share' => 'required|integer|min:1|max:100',
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
        ] + parent::validationAttributes();
    }

    private function load()
    {
        $this->items = Producer::where('media_id', $this->movie->media->id)->get()->toArray();
        $this->addUniqueKeys();
    }

    public function mount($movie_id = null)
    {
        $this->countries = Country::all()->keyBy('id')->toArray();
        $this->producer_roles = Producer::ROLES;
        if ($movie_id) {
            $this->movie = Movie::find($movie_id);
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
