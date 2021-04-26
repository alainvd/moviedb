<?php

namespace App\Models;

use App\Tools\Generic;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\Session;
use Spatie\Activitylog\Traits\CausesActivity;

class User extends Authenticatable
{
    use CausesActivity, Notifiable, HasRoles, HasFactory;

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
        if (isset($attributes['domainUsername'])) {
            return User::firstOrCreate(
                [
                    'eu_login_username' => $attributes['domainUsername']
                ],
                $attributes
            );
        }
    }

    public function setImpersonating($id)
    {
        Session::put('impersonate', $id);
    }

    public function stopImpersonating()
    {
        Session::forget('impersonate');
    }

    public function isImpersonating()
    {
        return Session::has('impersonate');
    }

}
