<?php

namespace App\Http\View\Composers;

use App\Models\Country;
use Illuminate\View\View;

class DistributorsComposer
{
    public function compose(View $view)
    {
        $countriesGrouped = Country::countriesGrouped();
        $distributorRoles = [
            'Coordinator',
            'Participant'
        ];

        $view->with('countriesGrouped', $countriesGrouped);
        $view->with('distributorRoles', $distributorRoles);
    }
}
