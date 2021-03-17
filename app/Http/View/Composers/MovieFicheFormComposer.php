<?php

namespace App\Http\View\Composers;

use App\Models\Genre;
use App\Models\Movie;
use App\Models\Status;
use App\Models\Country;
use App\Models\Audience;
use App\Models\Language;
use Illuminate\View\View;

class MovieFicheFormComposer
{
    /**
     * Bind data to the view
     */
    public function compose(View $view)
    {
        $movieAudiences = Audience::all()->where('type', 'App\Models\Movie')->toArray();
        $gameAudiences = Audience::all()->where('type', 'App\Models\VideoGame')->toArray();
        $allAudiencesById = Audience::all()->keyBy('id')->toArray();
        $countries = Country::where('active', true)
            ->get()
            ->toArray();
        $countriesByCode = Country::where('active', true)
            ->orderBy('name')
            ->get()
            ->keyBy('code')
            ->toArray();
        $countriesValueLabel = Country::where('active', true)
            ->get()
            ->map(fn ($country) => [
                'value' => $country->id,
                'label' => $country->name,
            ])
            ->toArray();
        $movieGenres = Genre::where('type', 'Movie')->get()->toArray();
        $gameGenres = Genre::where('type', 'VideoGame')->get()->toArray();
        $allGenresById = Genre::get()->keyBy('id')->toArray();
        $languages = Language::where('active', true)
            ->get()
            ->map(fn ($lang) => [
                'value' => $lang->id,
                'label' => $lang->name,
            ])
            ->toArray();
        $languagesWithCode = Language::where('active', true)
            ->get()
            ->map(fn ($lang) => [
                'code' => $lang->code,
                'name' => $lang->name,
            ])
            ->toArray();
        $statuses = Status::all()->toArray();
        $statusesById = Status::all()->keyBy('id')->toArray();
        $years = range(date('Y'), 1940);

        $view->with('movieAudiences', $movieAudiences);
        $view->with('gameAudiences', $gameAudiences);
        $view->with('allAaudiencesById', $allAudiencesById);
        $view->with('countries', $countries);
        $view->with('countriesByCode', $countriesByCode);
        $view->with('countriesValueLabel', $countriesValueLabel);
        $view->with('filmFormats', Movie::FILM_FORMATS);
        $view->with('filmTypes', Movie::FILM_TYPES);
        $view->with('movieGenres', $movieGenres);
        $view->with('gameGenres', $gameGenres);
        $view->with('allGenresById', $allGenresById);
        $view->with('languages', $languages);
        $view->with('languagesWithCode', $languagesWithCode);
        $view->with('platforms', Movie::PLATFORMS);
        $view->with('statuses', $statuses);
        $view->with('statusesById', $statusesById);
        $view->with('years', $years);
        $view->with('currencies', Movie::CURRENCIES);
        $view->with('linkApplicantWork', Movie::LINK_APPLICANT_WORK);
        $view->with('userExperiences', Movie::USER_EXPERIENCES);
        $view->with('workOrigins', Movie::WORK_ORIGINS);
        $view->with('workContractTypes', Movie::WORK_CONTRACT_TYPES);
        $view->with('documentTypes', Movie::DOCUMENT_TYPES);
        $view->with('producerRoles', Movie::PRODUCER_ROLES);
    }
}
