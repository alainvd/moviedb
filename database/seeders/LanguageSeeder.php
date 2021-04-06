<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('languages')->insert([
            [
                'code' => 'bg',
                'name' => 'български',
                'position' => 0
            ],
            [
                'code' => 'es',
                'name' => 'español',
                'position' => 0
            ],
            [
                'code' => 'cs',
                'name' => 'čeština',
                'position' => 0
            ],
            [
                'code' => 'da',
                'name' => 'dansk',
                'position' => 0
            ],
            [
                'code' => 'de',
                'name' => 'Deutsch',
                'position' => 0
            ],
            [
                'code' => 'et',
                'name' => 'eesti',
                'position' => 0
            ],
            [
                'code' => 'el',
                'name' => 'ελληνικά',
                'position' => 0
            ],
            [
                'code' => 'en',
                'name' => 'English',
                'position' => 0
            ],
            [
                'code' => 'fr',
                'name' => 'français',
                'position' => 0
            ],
            [
                'code' => 'ga',
                'name' => 'Gaeilge',
                'position' => 0
            ],
            [
                'code' => 'hr',
                'name' => 'hrvatski',
                'position' => 0
            ],
            [
                'code' => 'it',
                'name' => 'italiano',
                'position' => 0
            ],
            [
                'code' => 'lv',
                'name' => 'latviešu',
                'position' => 0
            ],
            [
                'code' => 'lt',
                'name' => 'lietuvių',
                'position' => 0
            ],
            [
                'code' => 'hu',
                'name' => 'magyar',
                'position' => 0
            ],
            [
                'code' => 'mt',
                'name' => 'Malti',
                'position' => 0
            ],
            [
                'code' => 'nl',
                'name' => 'Nederlands',
                'position' => 0            
            ],
            [
                'code' => 'pl',
                'name' => 'polski',
                'position' => 0
            ],
            [
                'code' => 'pt',
                'name' => 'português',
                'position' => 0
            ],
            [
                'code' => 'ro',
                'name' => 'română',
                'position' => 0
            ],
            [
                'code' => 'sk',
                'name' => 'slovenčina',
                'position' => 0
            ],
            [
                'code' => 'sl',
                'name' => 'slovenščina',
                'position' => 0
            ],
            [
                'code' => 'fi',
                'name' => 'suomi',
                'position' => 0
            ],
            [
                'code' => 'sv',
                'name' => 'svenska',
                'position' => 0
            ],
        ]);
    }
}
