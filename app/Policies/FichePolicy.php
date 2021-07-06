<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Fiche;
use Illuminate\Auth\Access\HandlesAuthorization;

class FichePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Fiche  $fiche
     * @return mixed
     */
    public function view(User $user, Fiche $fiche)
    {
        if ($user->hasAnyRole(['editor', 'super admin'])) {
            return true;
        }
        if ($user->hasRole('applicant')) {
            return $user->id === $fiche->created_by && $fiche->status->id === 1;
        }

        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Fiche  $fiche
     * @return mixed
     */
    public function update(User $user, Fiche $fiche)
    {
        if ($user->hasAnyRole(['editor', 'super admin'])) {
            return true;
        }
        if ($user->hasRole('applicant')) {
            return $user->id === $fiche->created_by && $fiche->status->id === 1;
        }

        return true;
    }
}
