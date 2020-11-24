<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Movie;
use App\Media;
use App\Models\Person;
use Illuminate\Support\Str;

class MovieDetailForm extends Component
{

    // Movie data for Livewire
    public Movie $movie;

    /**
     * Each wired fields needs to be here or it will be filtered
     */
    protected $rules = [
        'movie.original_title' => 'required|string|max:255|min:3',
        'movie.european_nationality_flag' => 'string|max:255',
        'movie.film_country_of_origin' => 'string|max:255',
        'movie.year_of_copyright' => 'integer',
        'movie.film_type' => 'string|max:255',
        'movie.imdb_url' => 'string|max:255',
        // 'movie.shooting_start' => 'date_format:d/m/Y',
        'movie.shooting_start' => 'date',
        // 'movie.shooting_end' => 'date_format:d/m/Y',
        'movie.shooting_end' => 'date',
        'movie.film_length' => 'string|max:255',
        'movie.film_format' => 'string|max:255',
    ];

    public function mount($movie_id = null)
    {
        if ($movie_id) {
            $this->movie = Movie::where('id', $movie_id)->first();
        } else {
            $this->movie = new Movie;
        };
    }

    public function render()
    {
        return view('livewire.movie-detail-form', [
            'languages'=>Media::LANGUAGES,
            'years'=>Media::YEARS(),
            'genres'=>Media::GENRES,
            'countries'=>Media::COUNTRIES,
        ]);
    }

    public function save()
    {
        // TODO: notify about validation errors (get stuff from Surge modal form)
        $this->validate();
        
        // Saving
        $_movie_create_form = !$this->movie->exists;
        $this->saveMovieDetails();
        $this->emitSelf('notify-saved');

        if ($_movie_create_form) {
            // Can't redirect while people are still being saved
            //return redirect()->to('/movie/detail/' . $this->movie->id);
            // TODO: tell browser to update the url
            // window.history.pushState('page2', 'Title', '/page2.php');
        }
    }

    /**
     * Save new or existing movie and people
     */
    private function saveMovieDetails()
    {
        $this->movie->save();
        $this->emit('save-movie-details', $this->movie->id);
    }

}
