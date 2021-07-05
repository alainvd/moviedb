<?php

namespace App\Http\View\Composers;

use App\Models\Genre;
use App\Models\Movie;
use App\Models\Status;
use App\Models\Country;
use App\Models\Audience;
use App\Models\Language;
use App\Models\GameOption;
use App\Models\GameMode;
use Illuminate\View\View;

class MovieFicheFormComposer
{
    /**
     * Bind data to the view
     */
    public function compose(View $view)
    {
        $movieAudiences = Audience::all()->where('type', 'Movie')->toArray();
        $gameAudiences = Audience::all()->where('type', 'VideoGame')->toArray();
        $allAudiencesById = Audience::all()->keyBy('id')->toArray();
        $countries = Country::countries();
        $countriesGrouped = Country::countriesGrouped();
        $countriesByCode = Country::countriesByCode();
        $countriesValueLabel = Country::countriesValueLabel();
        $movieGenres = Genre::where('type', 'Movie')->get()->toArray();
        $gameGenres = Genre::where('type', 'VideoGame')->get()->toArray();
        $allGenresById = Genre::get()->keyBy('id')->toArray();
        $languagesGrouped = Language::languagesGrouped();
        $languagesGroupedChoices = Language::languagesGroupedChoices();
        $languagesCodeName = Language::languagesCodeName();
        $gameOptionsChoices = GameOption::gameOptionsChoices();
        $gameModesChoices = GameMode::gameModesChoices();
        $statuses = Status::all()->toArray();
        $statusesDist = Status::where('dist', '=', 1)->get()->toArray();
        $statusesDev = Status::where('dev', '=', 1)->get()->toArray();
        $statusesById = Status::all()->keyBy('id')->toArray();
        $statusesByIdDist = Status::where('dist', '=', 1)->get()->keyBy('id')->toArray();
        $statusesByIdDev = Status::where('dev', '=', 1)->get()->keyBy('id')->toArray();
        $years = range(date('Y'), 1940);

        $view->with('movieAudiences', $movieAudiences);
        $view->with('gameAudiences', $gameAudiences);
        $view->with('allAaudiencesById', $allAudiencesById);
        $view->with('countries', $countries);
        $view->with('countriesGrouped', $countriesGrouped);
        $view->with('countriesByCode', $countriesByCode);
        $view->with('countriesValueLabel', $countriesValueLabel);
        $view->with('filmFormats', Movie::FILM_FORMATS);
        $view->with('filmTypes', Movie::FILM_TYPES);
        $view->with('movieGenres', $movieGenres);
        $view->with('gameGenres', $gameGenres);
        $view->with('allGenresById', $allGenresById);
        $view->with('languagesGrouped', $languagesGrouped);
        $view->with('languagesGroupedChoices', $languagesGroupedChoices);
        $view->with('languagesCodeName', $languagesCodeName);
        $view->with('gameOptionsChoices', $gameOptionsChoices);
        $view->with('gameModesChoices', $gameModesChoices);
        $view->with('platforms', Movie::PLATFORMS);
        $view->with('statuses', $statuses);
        $view->with('statusesDist', $statusesDist);
        $view->with('statusesDev', $statusesDev);
        $view->with('statusesById', $statusesById);
        $view->with('statusesByIdDist', $statusesByIdDist);
        $view->with('statusesByIdDev', $statusesByIdDev);
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
