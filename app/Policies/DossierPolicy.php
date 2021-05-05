<?php

namespace App\Policies;

use App\Models\Dossier;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DossierPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Dossier  $dossier
     * @return mixed
     */
    public function view(User $user, Dossier $dossier)
    {
        if ($user->hasRole('applicant')) {
            return $user->id === $dossier->created_by;
        }

        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Dossier  $dossier
     * @return mixed
     */
    public function update(User $user, Dossier $dossier)
    {
        if ($user->hasRole('applicant')) {
            return $user->id === $dossier->created_by;
        }

        return true;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Dossier  $dossier
     * @return mixed
     */
    public function delete(User $user, Dossier $dossier)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Dossier  $dossier
     * @return mixed
     */
    public function restore(User $user, Dossier $dossier)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Dossier  $dossier
     * @return mixed
     */
    public function forceDelete(User $user, Dossier $dossier)
    {
        //
    }
}
