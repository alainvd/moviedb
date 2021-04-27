<?php

namespace App\Models;

use App\Tools\Generic;
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
        if (isset($attributes['domainUsername']) || isset($attributes['eu_login_username'])) {
            if (isset($attributes['domainUsername'])) $username = $attributes['domainUsername'];
            if (isset($attributes['eu_login_username'])) $username = $attributes['eu_login_username'];
            $attributes['name'] = isset($attributes['firstName']) && isset($attributes['firstName']) ? $attributes['firstName'] . ' ' . $attributes['lastName'] : '';
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
            if (DB::table('model_has_roles')->where('model_id', '=', $user->id)->count() == 0) {
                DB::table('model_has_roles')->insert([
                    [
                        'role_id' => 1,
                        'model_type' => 'App\Models\User',
                        'model_id' => $user->id,
                    ],
                ]);
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
