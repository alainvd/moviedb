<?php

namespace App\Http\Livewire\Dossiers\Activities;

use App\Models\Dossier;
use App\Models\Activity;
use App\Models\Movie;
use Livewire\Component;

class Description extends Component
{
    public Activity $activity;
    public Dossier $dossier;

    public Movie $movie;

    protected $rules = [
        'movie.original_title' => 'required',
        'movie.film_country_of_origin' => 'required',
        'movie.year_of_copyright' => 'required',
        'movie.id' => 'required'
    ];

    public function mount()
    {
        $this->movie = new Movie();
        $movieId = request(['movie_id']);
        $fiche = $this->dossier->fiches()->first();

        if ($fiche) {
            $this->movie = $fiche->media->grantable;
        } else if ($movieId) {
            $found = Movie::find($movieId)->first();

            if ($found) {
                $this->movie = $found;
            }
        }
    }

    public function render()
    {
        return view('livewire.dossiers.activities.description');
    }
}
