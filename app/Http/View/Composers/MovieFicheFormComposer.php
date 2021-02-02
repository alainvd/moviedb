<?php

namespace App\Http\View\Composers;

use App\Models\Audience;
use App\Models\Genre;
use App\Models\Country;
use App\Models\Language;
use App\Models\Status;
use App\Models\Producer;
use Illuminate\View\View;

class MovieFicheFormComposer
{
    /**
     * Bind data to the view
     */
    public function compose(View $view)
    {
        $audiences = Audience::all();
        $countries = Country::where('active', true)
            ->get()
            ->toArray();
        $genres = Genre::where('type', 'App\Models\Movie')->get()->toArray();
        $languages = Language::where('active', true)
            ->get()
            ->map(fn ($lang) => [
                'value' => $lang->id,
                'label' => $lang->name,
            ])
            ->toArray();
        $platforms = [
            1 => 'Features / Cinema',
            2 => 'TV',
            3 => 'Digital',
        ];
        $filmFormats = [
            '35MM' => '35mm',
            'DIGITAL' => 'Digital',
            'OTHER' => 'Other',
        ];
        $filmTypes = [
            'ONEOFF' => 'One-off',
            'SERIES' => 'Series',
        ];
        $statuses = Status::all()->toArray();
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

        $view->with('audiences', $audiences->where('type', 'App\Models\Movie')->toArray());
        $view->with('countries', $countries);
        $view->with('filmFormats', $filmFormats);
        $view->with('filmTypes', $filmTypes);
        $view->with('genres', $genres);
        $view->with('languages', $languages);
        $view->with('platforms', $platforms);
        $view->with('statuses', $statuses);
        $view->with('years', $years);
        $view->with('currencies', $currencies);
        $view->with('linkApplicantWork', $linkApplicantWork);
        $view->with('userExperiences', $userExperiences);
        $view->with('workOrigins', $workOrigins);
        $view->with('workContractTypes', $workContractTypes);
    }
}
