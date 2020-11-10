<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => "Default User",
            'email' => Str::random(10).'@gmail.com',
            'eu_login_username' => env("CAS_MASQUERADE"),
            'password' => Hash::make('password'),
        ]);
    }
}
