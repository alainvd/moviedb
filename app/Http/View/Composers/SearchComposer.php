<?php

namespace App\Http\View\Composers;

use App\Models\Country;
use App\Models\Status;
use Illuminate\View\View;

class SearchComposer
{
    public function compose(View $view)
    {
        $countriesGrouped = Country::countriesGrouped();
        $years = collect(range(2004, date('Y')))->sortDesc();
        $statuses = Status::forFiche()
            ->whereNotIn('name', ['Duplicated', 'Rejected'])
            ->get();

        $view->with('countriesGrouped', $countriesGrouped);
        $view->with('statuses', $statuses);
        $view->with('years', $years);
    }
}
