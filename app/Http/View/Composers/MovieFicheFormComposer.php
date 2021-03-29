<?php

namespace App\Http\View\Composers;

use App\Models\Audience;
use App\Models\Genre;
use App\Models\Country;
use App\Models\Language;
use App\Models\Status;
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
            ->orderBy('position','desc')
            ->get() 
            ->map(fn ($lang) => [
                'value' => $lang->id,
                'label' => $lang->name,
            ])
            ->toArray();
        $languagesWithCode = Language::where('active', true)
            ->orderBy('position','desc')
            ->get()
            ->map(fn ($lang) => [
                'code' => $lang->code,
                'name' => $lang->name,
            ])
            ->toArray();
        $platforms = [
            'CINEMA' => 'Features / Cinema',
            'TV' => 'TV',
            'DIGITAL' => 'Digital',
        ];
        $filmFormats = [
            '35MM' => '35mm',
            'DIGITAL' => 'Digital',
            'OTHER' => 'Other',
        ];
        $filmTypes = [
            'ONEOFF' => 'One-off',
            'SERIES' => 'Series',
            'SHORT' => 'Short film',
        ];
        $statuses = Status::all()->toArray();
        $statusesById = Status::all()->keyBy('id')->toArray();
        $years = range(date('Y'), 1940);
        $currencies = [
            'EUR' => 'Euro',
            'USD' => 'US dollar',
            'JPY' => 'Japanese yen',
            'GBP' => 'Pound sterling',
            'CHF' => 'Swiss franc',
            'SEK' => 'Swedish krona',
        ];
        $linkApplicantWork = [
            'WRKPRODAP' => 'Work Produced by the Applicant Company',
            'WRKPERS' => 'Work where Personnal Credit is Eligible'
        ];
        $userExperiences = [
            'LINEAR' => 'Linear',
            'INTERACTIVE' => 'Interactive, non-linear (VR)'
        ];
        $workOrigins = [
            'ORIGINAL' => 'Original Work',
            'ADAPTATION' => 'Adaptation'
        ];
        $workContractTypes = [
            'CTONRTRANS' => 'Contract of transfer of rights',
            'PUBLIDOM' => 'Public domain',
            'OPTAGR' => 'Option Agreement of transfer of rights',
            'UNILATDECL' => 'Unilateral declaration of transfer of rights',
            'COPRODDEV' => 'Co-Production/co-development agreement',
        ];
        $documentTypes = [
            'FINANCING' => 'Financing plan',
            'OTHER' => 'Other',
        ];
        $producerRoles = [
            'PRODUCER' => 'Producer',
            'COPRODUCER' => 'Coproducer',
        ];

        $view->with('movieAudiences', $movieAudiences);
        $view->with('gameAudiences', $gameAudiences);
        $view->with('allAaudiencesById', $allAudiencesById);
        $view->with('countries', $countries);
        $view->with('countriesByCode', $countriesByCode);
        $view->with('countriesValueLabel', $countriesValueLabel);
        $view->with('filmFormats', $filmFormats);
        $view->with('filmTypes', $filmTypes);
        $view->with('movieGenres', $movieGenres);
        $view->with('gameGenres', $gameGenres);
        $view->with('allGenresById', $allGenresById);
        $view->with('languages', $languages);
        $view->with('languagesWithCode', $languagesWithCode);
        $view->with('platforms', $platforms);
        $view->with('statuses', $statuses);
        $view->with('statusesById', $statusesById);
        $view->with('years', $years);
        $view->with('currencies', $currencies);
        $view->with('linkApplicantWork', $linkApplicantWork);
        $view->with('userExperiences', $userExperiences);
        $view->with('workOrigins', $workOrigins);
        $view->with('workContractTypes', $workContractTypes);
        $view->with('documentTypes', $documentTypes);
        $view->with('producerRoles', $producerRoles);
    }
}
