<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\User;

Class ImpersonateController extends Controller {

    public function impersonate($id)
    {
        $user = User::find($id);
        Auth::user()->setImpersonating($user->id);

        return redirect()->back();
    }

    public function stopImpersonate()
    {
        Auth::user()->stopImpersonating();

        return redirect()->back();
    }

}
