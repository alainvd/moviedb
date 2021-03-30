<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('countries')->insert([
            ["group" => "other", "name" => "Andorra", "code" => "AD", "continent" => "EU", "position" => 0],
            ["group" => "other", "name" => "Albania", "code" => "AL", "continent" => "EU", "position" => 0],
            ["group" => "eu", "name" => "Austria", "code" => "AT", "continent" => "EU", "position" => 0],
            ["group" => "other", "name" => "Bosnia and Herzegovina", "code" => "BA", "continent" => "EU", "position" => 0],
            ["group" => "eu", "name" => "Belgium", "code" => "BE", "continent" => "EU", "position" => 10],
            ["group" => "eu", "name" => "Bulgaria", "code" => "BG", "continent" => "EU", "position" => 0],
            ["group" => "other", "name" => "Belarus", "code" => "BY", "continent" => "EU", "position" => 0],
            ["group" => "other", "name" => "Switzerland", "code" => "CH", "continent" => "EU", "position" => 0],
            ["group" => "eu", "name" => "Cyprus", "code" => "CY", "continent" => "EU", "position" => 0],
            ["group" => "eu", "name" => "Czech Republic", "code" => "CZ", "continent" => "EU", "position" => 0],
            ["group" => "select", "name" => "United Kingdom", "code" => "GB", "continent" => "EU", "position" => 0],
            ["group" => "eu", "name" => "Greece", "code" => "GR", "continent" => "EU", "position" => 0],
            ["group" => "eu", "name" => "Croatia", "code" => "HR", "continent" => "EU", "position" => 0],
            ["group" => "eu", "name" => "Hungary", "code" => "HU", "continent" => "EU", "position" => 0],
            ["group" => "eu", "name" => "Ireland", "code" => "IE", "continent" => "EU", "position" => 0],
            ["group" => "other", "name" => "Iceland", "code" => "IS", "continent" => "EU", "position" => 0],
            ["group" => "eu", "name" => "Italy", "code" => "IT", "continent" => "EU", "position" => 10],
            ["group" => "eu", "name" => "Lithuania", "code" => "LT", "continent" => "EU", "position" => 0],
            ["group" => "eu", "name" => "Luxembourg", "code" => "LU", "continent" => "EU", "position" => 10],
            ["group" => "eu", "name" => "Latvia", "code" => "LV", "continent" => "EU", "position" => 0],
            ["group" => "other", "name" => "Moldova", "code" => "MD", "continent" => "EU", "position" => 0],
            ["group" => "other", "name" => "Montenegro", "code" => "ME", "continent" => "EU", "position" => 0],
            ["group" => "other", "name" => "Macedonia", "code" => "MK", "continent" => "EU", "position" => 0],
            ["group" => "eu", "name" => "Malta", "code" => "MT", "continent" => "EU", "position" => 0],
            ["group" => "eu", "name" => "Netherlands", "code" => "NL", "continent" => "EU", "position" => 0],
            ["group" => "other", "name" => "Norway", "code" => "NO", "continent" => "EU", "position" => 0],
            ["group" => "eu", "name" => "Poland", "code" => "PL", "continent" => "EU", "position" => 0],
            ["group" => "eu", "name" => "Portugal", "code" => "PT", "continent" => "EU", "position" => 0],
            ["group" => "eu", "name" => "Romania", "code" => "RO", "continent" => "EU", "position" => 0],
            ["group" => "other", "name" => "Serbia", "code" => "RS", "continent" => "EU", "position" => 0],
            ["group" => "other", "name" => "Russia", "code" => "RU", "continent" => "EU", "position" => 0],
            ["group" => "eu", "name" => "Sweden", "code" => "SE", "continent" => "EU", "position" => 0],
            ["group" => "eu", "name" => "Slovenia", "code" => "SI", "continent" => "EU", "position" => 0],
            ["group" => "eu", "name" => "Slovakia", "code" => "SK", "continent" => "EU", "position" => 0],
            ["group" => "other", "name" => "San Marino", "code" => "SM", "continent" => "EU", "position" => 0],
            ["group" => "other", "name" => "Ukraine", "code" => "UA", "continent" => "EU", "position" => 0],
            ["group" => "other", "name" => "Kosovo", "code" => "XK", "continent" => "EU", "position" => 0],
            ["group" => "select", "name" => "United States", "code" => "US", "continent" => "NA", "position" => 1],
            ["group" => "other", "name" => "Canada", "code" => "CA", "continent" => "NA", "position" => 1],
            ["group" => "other", "name" => "El Salvador", "code" => "SV", "continent" => "NA", "position" => 0],
            ["group" => "other", "name" => "Morocco", "code" => "MA", "continent" => "AF", "position" => 0],
            ["group" => "other", "name" => "Mali", "code" => "ML", "continent" => "AF", "position" => 0],
            ["group" => "other", "name" => "Niger", "code" => "NE", "continent" => "AF", "position" => 0],

        ]);
    }
}
