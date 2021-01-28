<?php

namespace App\Http\View\Composers;

use App\Models\Country;
use Illuminate\View\View;

class DistributorsComposer
{
    public function compose(View $view)
    {
        $countries = Country::where('active', true)
            ->get()
            ->toArray();
        $distributorRoles = [
            'Coordinator',
            'Participant'
        ];

        $view->with('countries', $countries);
        $view->with('distributorRoles', $distributorRoles);
    }
}
