<?php

namespace App\Models;

use App\Tools\Generic;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\CausesActivity;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use CausesActivity, CrudTrait, Notifiable, HasRoles, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','eu_login_username'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function firstOrCreateByAttributes($attributes)
    {
        $attributes['password'] = Str::random(16);

        // Check if there is a user associated with this email
        if (isset($attributes['domainUsername']) || isset($attributes['eu_login_username'])) {
            if (isset($attributes['domainUsername'])) $username = $attributes['domainUsername'];
            if (isset($attributes['eu_login_username'])) $username = $attributes['eu_login_username'];
            $attributes['name'] = isset($attributes['firstName']) && isset($attributes['lastName'])
                ? $attributes['firstName'] . ' ' . $attributes['lastName']
                : (isset($attributes['name'])
                    ? $attributes['name']
                    : '');
            if(session()->has('impersonate')) {
                $user = User::where('id', session()->get('impersonate'))->first();
                $username = $user->eu_login_username;
            }
            $user = User::firstOrCreate(
                [
                    'eu_login_username' => $username,
                ],
                $attributes
            );

            // if departmentNumber: EACEA.B.2 => editor
            if (!$user->roles->count()) {
                if (isset($attributes['departmentNumber']) && Str::contains($attributes['departmentNumber'], 'EACEA.B.2'))
                {
                    $user->assignRole('editor');
                } else {
                    $user->assignRole('applicant');
                }
            }

            return $user;
        }
    }

    public function setImpersonating($id)
    {
        session()->put('impersonate', $id);
    }

    public function stopImpersonating()
    {
        session()->forget('impersonate');
    }

}
