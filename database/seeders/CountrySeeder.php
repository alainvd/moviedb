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
            ["name" => "Andorra", "code" => "AD", "continent" => "EU", "position" => 0],
            ["name" => "Albania", "code" => "AL", "continent" => "EU", "position" => 0],
            ["name" => "Austria", "code" => "AT", "continent" => "EU", "position" => 0],
            ["name" => "Bosnia and Herzegovina", "code" => "BA", "continent" => "EU", "position" => 0],
            ["name" => "Belgium", "code" => "BE", "continent" => "EU", "position" => 10],
            ["name" => "Bulgaria", "code" => "BG", "continent" => "EU", "position" => 0],
            ["name" => "Belarus", "code" => "BY", "continent" => "EU", "position" => 0],
            ["name" => "Switzerland", "code" => "CH", "continent" => "EU", "position" => 0],
            ["name" => "Cyprus", "code" => "CY", "continent" => "EU", "position" => 0],
            ["name" => "Czech Republic", "code" => "CZ", "continent" => "EU", "position" => 0],
            ["name" => "Germany", "code" => "DE", "continent" => "EU", "position" => 10],
            ["name" => "Denmark", "code" => "DK", "continent" => "EU", "position" => 0],
            ["name" => "Estonia", "code" => "EE", "continent" => "EU", "position" => 0],
            ["name" => "Spain", "code" => "ES", "continent" => "EU", "position" => 10],
            ["name" => "Finland", "code" => "FI", "continent" => "EU", "position" => 0],
            ["name" => "France", "code" => "FR", "continent" => "EU", "position" => 10],
            ["name" => "United Kingdom", "code" => "GB", "continent" => "EU", "position" => 0],
            ["name" => "Greece", "code" => "GR", "continent" => "EU", "position" => 0],
            ["name" => "Croatia", "code" => "HR", "continent" => "EU", "position" => 0],
            ["name" => "Hungary", "code" => "HU", "continent" => "EU", "position" => 0],
            ["name" => "Ireland", "code" => "IE", "continent" => "EU", "position" => 0],
            ["name" => "Iceland", "code" => "IS", "continent" => "EU", "position" => 0],
            ["name" => "Italy", "code" => "IT", "continent" => "EU", "position" => 10],
            ["name" => "Lithuania", "code" => "LT", "continent" => "EU", "position" => 0],
            ["name" => "Luxembourg", "code" => "LU", "continent" => "EU", "position" => 10],
            ["name" => "Latvia", "code" => "LV", "continent" => "EU", "position" => 0],
            ["name" => "Moldova", "code" => "MD", "continent" => "EU", "position" => 0],
            ["name" => "Montenegro", "code" => "ME", "continent" => "EU", "position" => 0],
            ["name" => "Macedonia", "code" => "MK", "continent" => "EU", "position" => 0],
            ["name" => "Malta", "code" => "MT", "continent" => "EU", "position" => 0],
            ["name" => "Netherlands", "code" => "NL", "continent" => "EU", "position" => 0],
            ["name" => "Norway", "code" => "NO", "continent" => "EU", "position" => 0],
            ["name" => "Poland", "code" => "PL", "continent" => "EU", "position" => 0],
            ["name" => "Portugal", "code" => "PT", "continent" => "EU", "position" => 0],
            ["name" => "Romania", "code" => "RO", "continent" => "EU", "position" => 0],
            ["name" => "Serbia", "code" => "RS", "continent" => "EU", "position" => 0],
            ["name" => "Russia", "code" => "RU", "continent" => "EU", "position" => 0],
            ["name" => "Sweden", "code" => "SE", "continent" => "EU", "position" => 0],
            ["name" => "Slovenia", "code" => "SI", "continent" => "EU", "position" => 0],
            ["name" => "Slovakia", "code" => "SK", "continent" => "EU", "position" => 0],
            ["name" => "San Marino", "code" => "SM", "continent" => "EU", "position" => 0],
            ["name" => "Ukraine", "code" => "UA", "continent" => "EU", "position" => 0],
            ["name" => "Kosovo", "code" => "XK", "continent" => "EU", "position" => 0],
            ["name" => "United States", "code" => "US", "continent" => "NA", "position" => 1],
            ["name" => "Canada", "code" => "CA", "continent" => "NA", "position" => 1],
            ["name" => "El Salvador", "code" => "SV", "continent" => "NA", "position" => 0],
            ["name" => "Morocco", "code" => "MA", "continent" => "AF", "position" => 0],
            ["name" => "Mali", "code" => "ML", "continent" => "AF", "position" => 0],
            ["name" => "Niger", "code" => "NE", "continent" => "AF", "position" => 0],

        ]);
    }
}
