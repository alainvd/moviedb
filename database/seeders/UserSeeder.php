<?php

namespace Database\Seeders;

use App\Models\Movie;
use App\Models\User;
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
        User::factory()->create([
            'name' => "Applicant",
            'email' => 'applicant@media-database.eu',
            'eu_login_username' => "mediadb-applicant",
            'password' => Hash::make(Str::random(20)),
        ])->assignRole('applicant');

        User::factory()->create([
            'name' => "Editor",
            'email' => 'editor@media-database.eu',
            'eu_login_username' => "mediadb-editor",
            'password' => Hash::make(Str::random(20)),
        ])->assignRole('editor');

        User::factory()->create([
            'name' => "Super Admin",
            'email' => 'super-admin@media-database.eu',
            'eu_login_username' => "mediadb-admin",
            'password' => Hash::make(Str::random(20)),
        ])->assignRole('super admin');

        for ($i = 0; $i < 20; $i++) {
            User::factory()->create()->assignRole('applicant');
        }

        for ($i = 0; $i < 10; $i++) {
            User::factory()->create()->assignRole('editor');
        }
    }
}
