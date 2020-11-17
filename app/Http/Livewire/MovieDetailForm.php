<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Movie;

class MovieDetailForm extends Component
{

    public Movie $movie;
    public $crew;
    public $cast;
    public $languages;
    public $years;
    public $genres;
    public $countries;

    protected $rules = [
        'movie.original_title' => 'string|min:255',
        'movie.european_nationality_flag' => 'string|min:255',
        'movie.film_country_of_origin' => 'string|min:255',
        'movie.year_of_copyright' => 'int',
        'movie.film_type' => 'string|min:255',
        'movie.imdb_url' => 'string|min:255',
        // 'movie.shooting_start' => 'date_format:d/m/Y',
        'movie.shooting_start' => 'date',
        // 'movie.shooting_end' => 'date_format:d/m/Y',
        'movie.shooting_end' => 'date',
        'movie.film_length' => 'string|min:255',
        'movie.film_format' => 'string|min:255',
        
    ];

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

    public function save()
    {
        // validate
        // save
        if (!$this->movie->exists) {
            $this->movie->save();
            return redirect()->to('/movie/detail/' . $this->movie->id);            
        } else {
            $this->movie->save();
        }
    }

    public function render()
    {
        return view('livewire.movie-detail-form', [
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
