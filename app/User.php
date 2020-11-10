<?php

namespace App;

use App\Tools\Generic;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use Notifiable;

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
        $password = Str::random(16);

        // Check if there is a user associated with this email
        return User::firstOrCreate(
            ['eu_login_username' => $attributes['uid']],
            [
                'name' => $attributes['firstName'] . ' ' . $attributes['lastName'],
                'email' => $attributes['email'],
                'password' => $password,
            ]
        );
    }
}
