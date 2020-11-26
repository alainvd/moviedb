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
                'name' => 'български'
            ],
            [
                'code' => 'es',
                'name' => 'español'
            ],
            [
                'code' => 'cs',
                'name' => 'čeština'
            ],
            [
                'code' => 'da',
                'name' => 'dansk'
            ],
            [
                'code' => 'de',
                'name' => 'Deutsch'
            ],
            [
                'code' => 'et',
                'name' => 'eesti'
            ],
            [
                'code' => 'el',
                'name' => 'ελληνικά'
            ],
            [
                'code' => 'en',
                'name' => 'English'
            ],
            [
                'code' => 'fr',
                'name' => 'français'
            ],
            [
                'code' => 'ga',
                'name' => 'Gaeilge'
            ],
            [
                'code' => 'hr',
                'name' => 'hrvatski'
            ],
            [
                'code' => 'it',
                'name' => 'italiano'
            ],
            [
                'code' => 'lv',
                'name' => 'latviešu'
            ],
            [
                'code' => 'lt',
                'name' => 'lietuvių'
            ],
            [
                'code' => 'hu',
                'name' => 'magyar'
            ],
            [
                'code' => 'mt',
                'name' => 'Malti'
            ],
            [
                'code' => 'nl',
                'name' => 'Nederlands'
            ],
            [
                'code' => 'pl',
                'name' => 'polski'
            ],
            [
                'code' => 'pt',
                'name' => 'português'
            ],
            [
                'code' => 'ro',
                'name' => 'română'
            ],
            [
                'code' => 'sk',
                'name' => 'slovenčina'
            ],
            [
                'code' => 'sl',
                'name' => 'slovenščina'
            ],
            [
                'code' => 'fi',
                'name' => 'suomi'
            ],
            [
                'code' => 'sv',
                'name' => 'svenska'
            ],
        ]);
    }
}
