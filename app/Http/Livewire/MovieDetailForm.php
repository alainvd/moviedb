<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Movie;
use App\Media;
use App\Person;
use Illuminate\Support\Str;

class MovieDetailForm extends Component
{

    // Fake field
    public $form_update_unique = 0;

    // Movie data for Livewire
    public Movie $movie;

    // Movie original
    public $movie_original = [];

    // Allow special editing
    public $backoffice = false;

    protected $listeners = ['movie-details-force-submit' => 'formSubmitForce'];

    /**
     * Each wired fields needs to be here or it will be filtered
     */
    protected $rules = [
        'form_update_unique' => 'required',
        'movie.original_title' => 'required|string|max:255',
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

    public function mount($movie_id = null, $backoffice = false)
    {
        if ($movie_id) {
            $this->movie = Movie::where('id', $movie_id)->first();
        } else {
            $this->movie = new Movie;
        };
        $this->movie_original = $this->movie->getOriginal();
    }

    public function render()
    {
    }

    public function formSubmitForce()
    {
        $this->form_update_unique = rand(0, 9999);
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
        $this->movie_original = $this->movie->getOriginal();
        $this->emit('save-movie-details', $this->movie->id);
    }

}
