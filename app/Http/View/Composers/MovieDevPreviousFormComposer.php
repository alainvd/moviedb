<?php

namespace App\Http\View\Composers;

use App\Audience;
use App\Genre;
use App\Models\Country;
use App\Models\Language;
use App\Models\Status;
use App\Producer;
use Illuminate\View\View;

class MovieDevPreviousFormComposer
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
        $genres = Genre::where('type', 'App\Movie')->get()->toArray();
        $languages = Language::where('active', true)
            ->get()
            ->map(fn ($lang) => [
                'value' => $lang->id,
                'label' => $lang->name,
            ])
            ->toArray();
        $platforms = [
            'Features / Cinema',
            'TV',
            'Digital',
        ];
        $filmFormats = [
            '35mm',
            'Digital',
            'Other',
        ];
        $filmTypes = [
            'One-off',
            'Series',
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

        $view->with('audiences', $audiences->where('type', 'App\Movie')->toArray());
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
    }
}
