<?php

namespace App\Http\Livewire;

use Livewire\Component;

class MovieDetails extends Component
{

    public $movie;
    public $crew;
    public $cast;
    public $languages;
    public $years;
    public $genres;
    public $countries;

    public function mount($movie, $crew, $cast, $languages, $years, $genres, $countries)
    {
        $this->movie = $movie;
        $this->crew = $crew;
        $this->cast = $cast;
        $this->languages = $languages;
        $this->years = $years;
        $this->genres = $genres;
        $this->countries = $countries;
    }

    public function render()
    {
        return view('livewire.movie-details', [
            'movie'=>$this->movie,
            'countries'=>$this->countries,
            'crew'=>$this->crew,
            'cast'=>$this->cast,
            'languages'=>$this->languages,
            'years'=>$this->years,
            'genres'=>$this->genres,
            'countries'=>$this->countries,
        ]);
    }
}
