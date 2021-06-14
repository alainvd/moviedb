<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

Class ImpersonateController extends Controller {

    public function impersonate($id)
    {
        if(!App::environment('production') && !App::environment('acceptance')) {
            $user = User::find($id);
            Auth::user()->setImpersonating($user->id);

            return redirect()->back();
        }
    }

    public function stopImpersonate()
    {
        if(!App::environment('production') && !App::environment('acceptance')) {
            Auth::user()->stopImpersonating();

            return redirect()->back();
        }
    }

}
