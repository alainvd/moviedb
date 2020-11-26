<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Movie;
use App\Media;
use App\Person;
use Illuminate\Support\Str;

class MovieDetailFormApplicant extends MovieDetailForm
{

    public function render()
    {
        return view('livewire.movie-detail-form-applicant', [
            'backoffice'=>$this->backoffice,
            'languages'=>Media::LANGUAGES,
            'years'=>Media::YEARS(),
            'genres'=>Media::GENRES,
            'countries'=>Media::COUNTRIES,
        ]);
    }

}
